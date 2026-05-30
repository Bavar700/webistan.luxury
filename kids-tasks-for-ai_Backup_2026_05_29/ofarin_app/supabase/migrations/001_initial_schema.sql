-- ══════════════════════════════════════════════════════════════════════════════
-- Офарин! Ту метавонӣ! — Supabase Database Schema
-- Version: 1.0.0
-- ══════════════════════════════════════════════════════════════════════════════

-- ============================================================================
-- ENUMS
-- ============================================================================

CREATE TYPE user_role AS ENUM ('parent', 'child');

CREATE TYPE currency_type AS ENUM ('fiat', 'star', 'gold');

CREATE TYPE task_status AS ENUM ('active', 'pending_approval', 'completed', 'rejected');

CREATE TYPE wishlist_status AS ENUM ('pending_pricing', 'active_goal', 'fulfilled');

-- ============================================================================
-- TABLES
-- ============================================================================

-- Profiles: Linked to auth.users, stores user info
CREATE TABLE profiles (
  id UUID PRIMARY KEY REFERENCES auth.users(id) ON DELETE CASCADE,
  family_id UUID NOT NULL,
  role user_role NOT NULL DEFAULT 'child',
  name TEXT NOT NULL DEFAULT '',
  avatar_url TEXT DEFAULT '',
  preferred_language TEXT DEFAULT 'ru',
  created_at TIMESTAMPTZ DEFAULT now(),
  updated_at TIMESTAMPTZ DEFAULT now()
);

-- Tasks: Assignments for children
CREATE TABLE tasks (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  child_id UUID NOT NULL REFERENCES profiles(id) ON DELETE CASCADE,
  parent_id UUID NOT NULL REFERENCES profiles(id) ON DELETE CASCADE,
  title TEXT NOT NULL,
  description TEXT NOT NULL DEFAULT '',
  is_bonus BOOLEAN NOT NULL DEFAULT false,
  timer_duration_mins INT DEFAULT NULL,
  deadline_at TIMESTAMPTZ DEFAULT NULL,
  reward_amount NUMERIC(12,2) NOT NULL DEFAULT 1,
  reward_currency currency_type NOT NULL DEFAULT 'star',
  penalty_amount NUMERIC(12,2) NOT NULL DEFAULT 0,
  penalty_currency currency_type NOT NULL DEFAULT 'star',
  proof_image_url TEXT DEFAULT NULL,
  reject_reason TEXT DEFAULT NULL,
  status task_status NOT NULL DEFAULT 'active',
  created_at TIMESTAMPTZ DEFAULT now(),
  updated_at TIMESTAMPTZ DEFAULT now()
);

-- Wallets: Triple-currency balance per child
CREATE TABLE wallets (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  child_id UUID NOT NULL UNIQUE REFERENCES profiles(id) ON DELETE CASCADE,
  balance_fiat NUMERIC(12,2) NOT NULL DEFAULT 0,
  balance_stars NUMERIC(12,2) NOT NULL DEFAULT 0,
  balance_gold NUMERIC(12,2) NOT NULL DEFAULT 0,
  created_at TIMESTAMPTZ DEFAULT now(),
  updated_at TIMESTAMPTZ DEFAULT now()
);

-- Wishlist: Children's dreams/desired items
CREATE TABLE wishlist (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  child_id UUID NOT NULL REFERENCES profiles(id) ON DELETE CASCADE,
  title TEXT NOT NULL,
  description TEXT DEFAULT '',
  image_url TEXT DEFAULT NULL,
  price_fiat NUMERIC(12,2) NOT NULL DEFAULT 0,
  price_stars NUMERIC(12,2) NOT NULL DEFAULT 0,
  price_gold NUMERIC(12,2) NOT NULL DEFAULT 0,
  status wishlist_status NOT NULL DEFAULT 'pending_pricing',
  created_at TIMESTAMPTZ DEFAULT now(),
  updated_at TIMESTAMPTZ DEFAULT now()
);

-- ============================================================================
-- INDEXES
-- ============================================================================

CREATE INDEX idx_profiles_family_id ON profiles(family_id);
CREATE INDEX idx_tasks_child_id ON tasks(child_id);
CREATE INDEX idx_tasks_parent_id ON tasks(parent_id);
CREATE INDEX idx_tasks_status ON tasks(status);
CREATE INDEX idx_wishlist_child_id ON wishlist(child_id);
CREATE INDEX idx_wishlist_status ON wishlist(status);

-- ============================================================================
-- ROW LEVEL SECURITY (RLS)
-- ============================================================================

-- Enable RLS on all tables
ALTER TABLE profiles ENABLE ROW LEVEL SECURITY;
ALTER TABLE tasks ENABLE ROW LEVEL SECURITY;
ALTER TABLE wallets ENABLE ROW LEVEL SECURITY;
ALTER TABLE wishlist ENABLE ROW LEVEL SECURITY;

-- Profiles RLS
-- Users can read their own profile and family members' profiles
CREATE POLICY "Users can read own and family profiles"
  ON profiles FOR SELECT
  USING (
    auth.uid() = id
    OR family_id IN (
      SELECT family_id FROM profiles WHERE id = auth.uid()
    )
  );

-- Users can update their own profile
CREATE POLICY "Users can update own profile"
  ON profiles FOR UPDATE
  USING (auth.uid() = id)
  WITH CHECK (auth.uid() = id);

-- Tasks RLS
-- Parents can CRUD tasks they created, children can see their assigned tasks
CREATE POLICY "Family members can read tasks"
  ON tasks FOR SELECT
  USING (
    child_id = auth.uid()
    OR parent_id = auth.uid()
    OR family_id IN (
      SELECT family_id FROM profiles WHERE id = auth.uid()
    )
  );

CREATE POLICY "Parents can create tasks"
  ON tasks FOR INSERT
  WITH CHECK (
    EXISTS (
      SELECT 1 FROM profiles
      WHERE id = auth.uid() AND role = 'parent'
    )
  );

CREATE POLICY "Parents can update tasks"
  ON tasks FOR UPDATE
  USING (parent_id = auth.uid())
  WITH CHECK (parent_id = auth.uid());

-- Children can update specific fields (proof_image_url, status -> pending_approval)
CREATE POLICY "Children can submit proof"
  ON tasks FOR UPDATE
  USING (child_id = auth.uid())
  WITH CHECK (child_id = auth.uid());

-- Wallets RLS
-- Family members can view wallets
CREATE POLICY "Family members can read wallets"
  ON wallets FOR SELECT
  USING (
    child_id = auth.uid()
    OR family_id IN (
      SELECT family_id FROM profiles WHERE id = auth.uid()
    )
  );

-- Only the system/parent can update wallets (via functions)
CREATE POLICY "Parents can update wallets"
  ON wallets FOR UPDATE
  USING (
    EXISTS (
      SELECT 1 FROM profiles
      WHERE id = auth.uid() AND role = 'parent'
      AND family_id = (SELECT family_id FROM profiles WHERE id = wallets.child_id)
    )
  );

-- Wishlist RLS
CREATE POLICY "Family members can read wishlist"
  ON wishlist FOR SELECT
  USING (
    child_id = auth.uid()
    OR family_id IN (
      SELECT family_id FROM profiles WHERE id = auth.uid()
    )
  );

CREATE POLICY "Children can create wishlist items"
  ON wishlist FOR INSERT
  WITH CHECK (child_id = auth.uid());

CREATE POLICY "Parents can update wishlist items"
  ON wishlist FOR UPDATE
  USING (
    EXISTS (
      SELECT 1 FROM profiles
      WHERE id = auth.uid() AND role = 'parent'
      AND family_id = (SELECT family_id FROM profiles WHERE id = auth.uid())
    )
  );

-- ============================================================================
-- STORAGE BUCKETS
-- ============================================================================

INSERT INTO storage.buckets (id, name, public, file_size_limit, allowed_mime_types)
VALUES
  ('task-proofs', 'task-proofs', FALSE, 5242880, ARRAY['image/jpeg', 'image/png', 'image/webp']),
  ('wishlist-images', 'wishlist-images', TRUE, 10485760, ARRAY['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
ON CONFLICT (id) DO NOTHING;

-- Storage RLS: Only authenticated users can upload/read files
CREATE POLICY "Family can read task proofs"
  ON storage.objects FOR SELECT
  USING (
    bucket_id = 'task-proofs'
    AND EXISTS (
      SELECT 1 FROM profiles
      WHERE id = auth.uid()
    )
  );

CREATE POLICY "Children can upload task proofs"
  ON storage.objects FOR INSERT
  WITH CHECK (
    bucket_id = 'task-proofs'
    AND auth.role() = 'authenticated'
  );

CREATE POLICY "Anyone can read wishlist images"
  ON storage.objects FOR SELECT
  USING (bucket_id = 'wishlist-images');

CREATE POLICY "Authenticated users can upload wishlist images"
  ON storage.objects FOR INSERT
  WITH CHECK (
    bucket_id = 'wishlist-images'
    AND auth.role() = 'authenticated'
  );

-- ============================================================================
-- TRIGGERS & FUNCTIONS
-- ============================================================================

-- Auto-create profile on user signup
CREATE OR REPLACE FUNCTION handle_new_user()
RETURNS TRIGGER
LANGUAGE plpgsql
SECURITY DEFINER
SET search_path = ''
AS $$
DECLARE
  v_family_id UUID;
  v_role user_role;
BEGIN
  -- Generate a new family_id for new families
  v_family_id := COALESCE(NEW.raw_user_meta_data ->> 'family_id', gen_random_uuid()::TEXT)::UUID;
  v_role := COALESCE((NEW.raw_user_meta_data ->> 'role'), 'child')::user_role;

  -- Insert profile
  INSERT INTO public.profiles (id, family_id, role, name, preferred_language)
  VALUES (
    NEW.id,
    v_family_id,
    v_role,
    COALESCE(NEW.raw_user_meta_data ->> 'name', ''),
    COALESCE(NEW.raw_user_meta_data ->> 'preferred_language', 'ru')
  );

  -- Create wallet only for children
  IF v_role = 'child' THEN
    INSERT INTO public.wallets (child_id)
    VALUES (NEW.id);
  END IF;

  RETURN NEW;
END;
$$;

CREATE OR REPLACE TRIGGER on_auth_user_created
  AFTER INSERT ON auth.users
  FOR EACH ROW
  EXECUTE FUNCTION handle_new_user();

-- Updated_at trigger helper
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $$
BEGIN
  NEW.updated_at = now();
  RETURN NEW;
END;
$$;

CREATE OR REPLACE TRIGGER update_profiles_updated_at
  BEFORE UPDATE ON profiles
  FOR EACH ROW
  EXECUTE FUNCTION update_updated_at_column();

CREATE OR REPLACE TRIGGER update_tasks_updated_at
  BEFORE UPDATE ON tasks
  FOR EACH ROW
  EXECUTE FUNCTION update_updated_at_column();

CREATE OR REPLACE TRIGGER update_wallets_updated_at
  BEFORE UPDATE ON wallets
  FOR EACH ROW
  EXECUTE FUNCTION update_updated_at_column();

CREATE OR REPLACE TRIGGER update_wishlist_updated_at
  BEFORE UPDATE ON wishlist
  FOR EACH ROW
  EXECUTE FUNCTION update_updated_at_column();

-- ============================================================================
-- HELPER FUNCTIONS
-- ============================================================================

-- Get wallet balance for a child
CREATE OR REPLACE FUNCTION get_wallet(p_child_id UUID)
RETURNS TABLE(
  balance_fiat NUMERIC,
  balance_stars NUMERIC,
  balance_gold NUMERIC
)
LANGUAGE plpgsql
SECURITY DEFINER
SET search_path = ''
AS $$
BEGIN
  RETURN QUERY
  SELECT w.balance_fiat, w.balance_stars, w.balance_gold
  FROM public.wallets w
  WHERE w.child_id = p_child_id;
END;
$$;

-- Get task summary for a child (count by status)
CREATE OR REPLACE FUNCTION get_task_summary(p_child_id UUID)
RETURNS TABLE(
  total_active BIGINT,
  total_pending BIGINT,
  total_completed BIGINT
)
LANGUAGE plpgsql
SECURITY DEFINER
SET search_path = ''
AS $$
BEGIN
  RETURN QUERY
  SELECT
    COUNT(*) FILTER (WHERE status = 'active')::BIGINT,
    COUNT(*) FILTER (WHERE status = 'pending_approval')::BIGINT,
    COUNT(*) FILTER (WHERE status = 'completed')::BIGINT
  FROM public.tasks t
  WHERE t.child_id = p_child_id;
END;
$$;

-- Fulfill a wishlist item (deduct balance, mark as fulfilled)
CREATE OR REPLACE FUNCTION fulfill_wishlist(
  p_wishlist_id UUID,
  p_parent_uuid UUID
)
RETURNS BOOLEAN
LANGUAGE plpgsql
SECURITY DEFINER
SET search_path = ''
AS $$
DECLARE
  v_child_id UUID;
  v_family_id UUID;
  v_price_fiat NUMERIC;
  v_price_stars NUMERIC;
  v_price_gold NUMERIC;
  v_balance_fiat NUMERIC;
  v_balance_stars NUMERIC;
  v_balance_gold NUMERIC;
BEGIN
  -- Get wishlist details
  SELECT child_id, price_fiat, price_stars, price_gold
  INTO v_child_id, v_price_fiat, v_price_stars, v_price_gold
  FROM public.wishlist
  WHERE id = p_wishlist_id AND status = 'active_goal';

  IF NOT FOUND THEN
    RETURN FALSE;
  END IF;

  -- Verify parent relationship
  SELECT family_id INTO v_family_id
  FROM public.profiles
  WHERE id = p_parent_uuid AND role = 'parent';

  IF NOT FOUND THEN
    RETURN FALSE;
  END IF;

  -- Check and deduct balance
  SELECT balance_fiat, balance_stars, balance_gold
  INTO v_balance_fiat, v_balance_stars, v_balance_gold
  FROM public.wallets
  WHERE child_id = v_child_id;

  IF v_balance_fiat >= v_price_fiat
     AND v_balance_stars >= v_price_stars
     AND v_balance_gold >= v_price_gold THEN

    UPDATE public.wallets
    SET
      balance_fiat = balance_fiat - v_price_fiat,
      balance_stars = balance_stars - v_price_stars,
      balance_gold = balance_gold - v_price_gold
    WHERE child_id = v_child_id;

    UPDATE public.wishlist
    SET status = 'fulfilled', updated_at = now()
    WHERE id = p_wishlist_id;

    RETURN TRUE;
  END IF;

  RETURN FALSE;
END;
$$;

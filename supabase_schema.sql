-- ==========================================
-- 1. ENUMS
-- ==========================================
CREATE TYPE currency_type AS ENUM ('fiat', 'star', 'gold');
CREATE TYPE user_role AS ENUM ('parent', 'child');
CREATE TYPE task_status AS ENUM ('active', 'pending_approval', 'completed', 'rejected');
CREATE TYPE wishlist_status AS ENUM ('pending_pricing', 'active_goal', 'fulfilled');

-- ==========================================
-- 2. TABLES
-- ==========================================

-- PROFILES
CREATE TABLE profiles (
  id UUID REFERENCES auth.users ON DELETE CASCADE PRIMARY KEY,
  family_id UUID NOT NULL,
  role user_role NOT NULL,
  name TEXT NOT NULL,
  avatar_url TEXT,
  preferred_language TEXT DEFAULT 'tg'
);

-- WALLETS
CREATE TABLE wallets (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  child_id UUID REFERENCES profiles(id) ON DELETE CASCADE UNIQUE NOT NULL,
  balance_fiat NUMERIC DEFAULT 0.0,
  balance_stars INTEGER DEFAULT 0,
  balance_gold INTEGER DEFAULT 0
);

-- TASKS
CREATE TABLE tasks (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  child_id UUID REFERENCES profiles(id) ON DELETE CASCADE NOT NULL,
  parent_id UUID REFERENCES profiles(id) ON DELETE CASCADE NOT NULL,
  title TEXT NOT NULL,
  description TEXT NOT NULL,
  is_bonus BOOLEAN DEFAULT FALSE,
  timer_duration_mins INTEGER,
  deadline_at TIMESTAMPTZ,
  reward_amount NUMERIC NOT NULL,
  reward_currency currency_type NOT NULL,
  penalty_amount NUMERIC DEFAULT 0,
  penalty_currency currency_type,
  proof_image_url TEXT,
  reject_reason TEXT,
  status task_status DEFAULT 'active' NOT NULL,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- WISHLIST
CREATE TABLE wishlist (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  child_id UUID REFERENCES profiles(id) ON DELETE CASCADE NOT NULL,
  title TEXT NOT NULL,
  description TEXT,
  image_url TEXT,
  price_fiat NUMERIC,
  price_stars INTEGER,
  price_gold INTEGER,
  status wishlist_status DEFAULT 'pending_pricing' NOT NULL,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- ==========================================
-- 3. STORAGE BUCKETS
-- ==========================================
INSERT INTO storage.buckets (id, name, public) VALUES ('proofs', 'proofs', true) ON CONFLICT DO NOTHING;
INSERT INTO storage.buckets (id, name, public) VALUES ('wishlist_images', 'wishlist_images', true) ON CONFLICT DO NOTHING;

-- ==========================================
-- 4. ROW LEVEL SECURITY (RLS) POLICIES
-- ==========================================

ALTER TABLE profiles ENABLE ROW LEVEL SECURITY;
ALTER TABLE wallets ENABLE ROW LEVEL SECURITY;
ALTER TABLE tasks ENABLE ROW LEVEL SECURITY;
ALTER TABLE wishlist ENABLE ROW LEVEL SECURITY;

CREATE OR REPLACE FUNCTION get_current_family_id()
RETURNS UUID AS $$
  SELECT family_id FROM profiles WHERE id = auth.uid() LIMIT 1;
$$ LANGUAGE sql SECURITY DEFINER;

-- Profiles Policies
CREATE POLICY "Users can view their family profiles" ON profiles
  FOR SELECT USING (family_id = get_current_family_id());

CREATE POLICY "Users can update their own profile" ON profiles
  FOR UPDATE USING (id = auth.uid());

CREATE POLICY "Users can insert their own profile" ON profiles
  FOR INSERT WITH CHECK (id = auth.uid());

-- Wallets Policies
CREATE POLICY "Family can view wallets" ON wallets
  FOR SELECT USING (
    child_id IN (SELECT id FROM profiles WHERE family_id = get_current_family_id())
  );

CREATE POLICY "Parents can update wallets" ON wallets
  FOR UPDATE USING (
    EXISTS (SELECT 1 FROM profiles WHERE id = auth.uid() AND role = 'parent' AND family_id = get_current_family_id())
  );

-- Tasks Policies
CREATE POLICY "Family can view tasks" ON tasks
  FOR SELECT USING (
    child_id IN (SELECT id FROM profiles WHERE family_id = get_current_family_id())
  );

CREATE POLICY "Parents can insert tasks" ON tasks
  FOR INSERT WITH CHECK (
    parent_id = auth.uid() AND
    EXISTS (SELECT 1 FROM profiles WHERE id = auth.uid() AND role = 'parent')
  );

CREATE POLICY "Family can update tasks" ON tasks
  FOR UPDATE USING (
    child_id IN (SELECT id FROM profiles WHERE family_id = get_current_family_id())
  );

-- Wishlist Policies
CREATE POLICY "Family can view wishlist" ON wishlist
  FOR SELECT USING (
    child_id IN (SELECT id FROM profiles WHERE family_id = get_current_family_id())
  );

CREATE POLICY "Family can insert wishlist items" ON wishlist
  FOR INSERT WITH CHECK (
    child_id IN (SELECT id FROM profiles WHERE family_id = get_current_family_id())
  );

CREATE POLICY "Family can update wishlist items" ON wishlist
  FOR UPDATE USING (
    child_id IN (SELECT id FROM profiles WHERE family_id = get_current_family_id())
  );

-- Storage Policies
CREATE POLICY "Authenticated users can upload proofs" ON storage.objects
  FOR INSERT WITH CHECK (bucket_id = 'proofs' AND auth.role() = 'authenticated');

CREATE POLICY "Authenticated users can view proofs" ON storage.objects
  FOR SELECT USING (bucket_id = 'proofs' AND auth.role() = 'authenticated');

CREATE POLICY "Authenticated users can upload wishlist images" ON storage.objects
  FOR INSERT WITH CHECK (bucket_id = 'wishlist_images' AND auth.role() = 'authenticated');

CREATE POLICY "Authenticated users can view wishlist images" ON storage.objects
  FOR SELECT USING (bucket_id = 'wishlist_images' AND auth.role() = 'authenticated');

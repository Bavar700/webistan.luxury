-- "Офарин! Ту метавонӣ!" - Database Schema (PostgreSQL/Supabase)
-- Target Workspace: Ofarin Gamified Family Task & Finance App

-- Enable UUID extension
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- 1. PROFILES TABLE
-- Extends Auth Users (if using Supabase Auth) or custom profiles.
CREATE TABLE IF NOT EXISTS public.profiles (
    id UUID PRIMARY KEY REFERENCES auth.users(id) ON DELETE CASCADE,
    role TEXT NOT NULL CHECK (role IN ('parent', 'child')),
    parent_id UUID REFERENCES public.profiles(id) ON DELETE SET NULL, -- Self-referencing link for children to parent
    display_name TEXT NOT NULL,
    avatar_url TEXT,
    pin_hash TEXT, -- Stored hashed PIN (e.g., SHA256) for Parent Mode access
    stars_balance INTEGER DEFAULT 0 CHECK (stars_balance >= 0),
    fiat_balance NUMERIC(10, 2) DEFAULT 0.00 CHECK (fiat_balance >= 0.00),
    streak_count INTEGER DEFAULT 0 CHECK (streak_count >= 0),
    last_active_date DATE,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Index for parent-child relationship query optimization
CREATE INDEX IF NOT EXISTS idx_profiles_parent_id ON public.profiles(parent_id);

-- 2. TASKS TABLE
-- Supports routine daily/weekly checks, specific deadlines, bonus tasks, and timer locks.
CREATE TABLE IF NOT EXISTS public.tasks (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    parent_id UUID NOT NULL REFERENCES public.profiles(id) ON DELETE CASCADE,
    child_id UUID NOT NULL REFERENCES public.profiles(id) ON DELETE CASCADE,
    title TEXT NOT NULL,
    description TEXT,
    task_type TEXT NOT NULL CHECK (task_type IN ('routine', 'deadline', 'bonus', 'timer_lock')),
    reward_type TEXT NOT NULL CHECK (reward_type IN ('stars', 'fiat')),
    reward_amount NUMERIC(10, 2) NOT NULL CHECK (reward_amount >= 0.00),
    penalty_amount NUMERIC(10, 2) DEFAULT 0.00 CHECK (penalty_amount >= 0.00),
    status TEXT NOT NULL DEFAULT 'todo' CHECK (status IN ('todo', 'in_progress', 'done_pending_approval', 'completed', 'failed')),
    deadline TIMESTAMP WITH TIME ZONE,
    timer_duration_seconds INTEGER, -- Mandatory lock time for task_type = 'timer_lock'
    time_spent_seconds INTEGER DEFAULT 0,
    timer_started_at TIMESTAMP WITH TIME ZONE,
    completed_at TIMESTAMP WITH TIME ZONE,
    approved_at TIMESTAMP WITH TIME ZONE,
    submission_comment TEXT,
    submission_image_url TEXT,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_tasks_child_id ON public.tasks(child_id);
CREATE INDEX IF NOT EXISTS idx_tasks_status ON public.tasks(status);

-- 3. WISHLIST ITEMS
-- Items kids want parent to pay for or buy when goal balance is met.
CREATE TABLE IF NOT EXISTS public.wishlist_items (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    child_id UUID NOT NULL REFERENCES public.profiles(id) ON DELETE CASCADE,
    title TEXT NOT NULL,
    description TEXT,
    cost_amount NUMERIC(10, 2) NOT NULL CHECK (cost_amount > 0.00),
    currency_type TEXT NOT NULL CHECK (currency_type IN ('stars', 'fiat')),
    status TEXT NOT NULL DEFAULT 'pending' CHECK (status IN ('pending', 'approved', 'paid', 'rejected')),
    image_url TEXT,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_wishlist_child_id ON public.wishlist_items(child_id);

-- 4. TRANSACTIONS TABLE
-- Financial ledger tracking balance updates (rewards, penalties, manual adjustments, payouts).
CREATE TABLE IF NOT EXISTS public.transactions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    child_id UUID NOT NULL REFERENCES public.profiles(id) ON DELETE CASCADE,
    parent_id UUID REFERENCES public.profiles(id) ON DELETE SET NULL, -- Audits which parent authorized/adjusted
    task_id UUID REFERENCES public.tasks(id) ON DELETE SET NULL, -- Null if manual adjustment or wishlist purchase
    amount NUMERIC(10, 2) NOT NULL, -- Positive for rewards, negative for deductions/purchases
    currency_type TEXT NOT NULL CHECK (currency_type IN ('stars', 'fiat')),
    transaction_type TEXT NOT NULL CHECK (transaction_type IN ('task_reward', 'penalty_deduction', 'wishlist_payout', 'manual_adjustment')),
    description TEXT,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_transactions_child_id ON public.transactions(child_id);

-- 5. PROFILE AUTO-CREATION TRIGGER
-- Triggers profile row creation when a user registers in auth.users via Supabase Auth
CREATE OR REPLACE FUNCTION public.handle_new_user()
RETURNS TRIGGER AS $$
BEGIN
  INSERT INTO public.profiles (id, display_name, role, avatar_url)
  VALUES (
    NEW.id,
    COALESCE(NEW.raw_user_meta_data->>'display_name', 'User'),
    COALESCE(NEW.raw_user_meta_data->>'role', 'parent'),
    NEW.raw_user_meta_data->>'avatar_url'
  );
  RETURN NEW;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- Recreate trigger if exists
DROP TRIGGER IF EXISTS on_auth_user_created ON auth.users;
CREATE TRIGGER on_auth_user_created
  AFTER INSERT ON auth.users
  FOR EACH ROW EXECUTE FUNCTION public.handle_new_user();

-- 6. ENABLE ROW LEVEL SECURITY
ALTER TABLE public.profiles ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.tasks ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.wishlist_items ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.transactions ENABLE ROW LEVEL SECURITY;

-- 7. SECURITY HELPER FUNCTIONS
-- Check if user is parent
CREATE OR REPLACE FUNCTION public.is_parent(user_id UUID)
RETURNS BOOLEAN AS $$
BEGIN
  RETURN EXISTS (
    SELECT 1 FROM public.profiles
    WHERE id = user_id AND role = 'parent'
  );
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- 8. PROFILES POLICIES
-- Anyone authenticated can select profiles
CREATE POLICY select_profiles ON public.profiles
  FOR SELECT TO authenticated USING (true);

-- Parents can update any profiles (balances, streaks, PINs)
CREATE POLICY update_profiles_parent ON public.profiles
  FOR UPDATE TO authenticated
  USING (public.is_parent(auth.uid()))
  WITH CHECK (public.is_parent(auth.uid()));

-- Children can only update their own display name or avatar, NOT balances or PIN hashes
CREATE POLICY update_profiles_child ON public.profiles
  FOR UPDATE TO authenticated
  USING (auth.uid() = id)
  WITH CHECK (
    auth.uid() = id 
    AND (role = 'child')
    AND (stars_balance = stars_balance)
    AND (fiat_balance = fiat_balance)
    AND (pin_hash IS NOT DISTINCT FROM pin_hash)
  );

-- 9. TASKS POLICIES
-- Authenticated users can view tasks linked to them
CREATE POLICY select_tasks ON public.tasks
  FOR SELECT TO authenticated
  USING (
    parent_id = auth.uid() 
    OR child_id = auth.uid()
  );

-- Only parents can insert/create tasks
CREATE POLICY insert_tasks_parent ON public.tasks
  FOR INSERT TO authenticated
  WITH CHECK (parent_id = auth.uid() AND public.is_parent(auth.uid()));

-- Only parents can delete tasks
CREATE POLICY delete_tasks_parent ON public.tasks
  FOR DELETE TO authenticated
  USING (parent_id = auth.uid() AND public.is_parent(auth.uid()));

-- Parents can update any fields on tasks
CREATE POLICY update_tasks_parent ON public.tasks
  FOR UPDATE TO authenticated
  USING (parent_id = auth.uid() AND public.is_parent(auth.uid()))
  WITH CHECK (parent_id = auth.uid() AND public.is_parent(auth.uid()));

-- Children can only update task status (to done_pending_approval or in_progress)
CREATE POLICY update_tasks_child ON public.tasks
  FOR UPDATE TO authenticated
  USING (child_id = auth.uid())
  WITH CHECK (
    child_id = auth.uid()
    AND status IN ('in_progress', 'done_pending_approval')
    AND title = title
    AND reward_amount = reward_amount
    AND reward_type = reward_type
  );

-- 10. WISHLIST POLICIES
-- Authenticated users can view wishlist items
CREATE POLICY select_wishlist ON public.wishlist_items
  FOR SELECT TO authenticated
  USING (
    child_id = auth.uid()
    OR EXISTS (
      SELECT 1 FROM public.profiles
      WHERE id = child_id AND parent_id = auth.uid()
    )
  );

-- Children can create wishlist items for themselves
CREATE POLICY insert_wishlist_child ON public.wishlist_items
  FOR INSERT TO authenticated
  WITH CHECK (child_id = auth.uid());

-- Children can update status of their wishlist items to 'approved' (request purchase)
CREATE POLICY update_wishlist_child ON public.wishlist_items
  FOR UPDATE TO authenticated
  USING (child_id = auth.uid())
  WITH CHECK (
    child_id = auth.uid()
    AND status = 'approved'
    AND cost_amount = cost_amount
  );

-- Parents can update/approve or delete wishlist items
CREATE POLICY manage_wishlist_parent ON public.wishlist_items
  FOR ALL TO authenticated
  USING (
    EXISTS (
      SELECT 1 FROM public.profiles
      WHERE id = child_id AND parent_id = auth.uid() AND public.is_parent(auth.uid())
    )
  );

-- 11. TRANSACTIONS POLICIES (Append-only ledger logs)
-- Authenticated users can read transactions linked to them
CREATE POLICY select_transactions ON public.transactions
  FOR SELECT TO authenticated
  USING (
    child_id = auth.uid()
    OR parent_id = auth.uid()
  );

-- Only parents can log transactions
CREATE POLICY insert_transactions_parent ON public.transactions
  FOR INSERT TO authenticated
  WITH CHECK (
    parent_id = auth.uid()
    AND public.is_parent(auth.uid())
  );

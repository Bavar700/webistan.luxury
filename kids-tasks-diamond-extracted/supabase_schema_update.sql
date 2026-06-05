-- ========================================================
-- Schema Update: Family States for Real-Time Sync
-- Run this in the SQL Editor of your Supabase Dashboard
-- ========================================================

-- Create the family_states table to store the unified JSON state
CREATE TABLE IF NOT EXISTS family_states (
  id UUID REFERENCES auth.users ON DELETE CASCADE PRIMARY KEY,
  state JSONB NOT NULL,
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Enable Row Level Security (RLS)
ALTER TABLE family_states ENABLE ROW LEVEL SECURITY;

-- Create policy to allow authenticated users to only read/write their own family state
DROP POLICY IF EXISTS "Manage own family state" ON family_states;
CREATE POLICY "Manage own family state" ON family_states
  FOR ALL TO authenticated USING (id = auth.uid()) WITH CHECK (id = auth.uid());

-- Enable Supabase Realtime for the family_states table
-- (Allows instant state updates on other devices when a change occurs)
ALTER PUBLICATION supabase_realtime ADD TABLE family_states;

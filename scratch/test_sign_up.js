const SUPABASE_URL = 'https://pegxtmauqavxcnmiqoaz.supabase.co'; 
const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InBlZ3h0bWF1cWF2eGNubWlxb2F6Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NzQ2ODcsImV4cCI6MjA5NjE1MDY4N30._7DbonZtdU5GFGqPa9lgQaXbqxxGHlkxol_LgjPghNY'; 

async function testSignUp() {
    console.log('Testing sign-up to Supabase...');
    const url = `${SUPABASE_URL}/auth/v1/signup`;
    
    // Generate a unique email
    const email = `test_${Date.now()}@example.com`;
    const password = 'testpassword123';
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'apikey': SUPABASE_ANON_KEY,
                'Authorization': `Bearer ${SUPABASE_ANON_KEY}`
            },
            body: JSON.stringify({
                email,
                password
            })
        });
        
        console.log('Status:', response.status);
        console.log('Status Text:', response.statusText);
        const data = await response.json();
        console.log('Response data:', JSON.stringify(data, null, 2));
    } catch (e) {
        console.error('Error during fetch:', e);
    }
}

testSignUp();

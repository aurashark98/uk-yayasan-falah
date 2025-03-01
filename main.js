// Smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Donation calculator
function calculateZakat() {
    const income = document.getElementById('income').value;
    const savings = document.getElementById('savings').value;
    const investments = document.getElementById('investments').value;

    const total = (parseFloat(income) + parseFloat(savings) + parseFloat(investments)) * 0.025;
    
    document.getElementById('zakat-result').innerHTML = `
        Zakat yang harus dibayarkan: Rp ${total.toLocaleString('id-ID')}
    `;
}

// Newsletter subscription
const newsletterForm = document.getElementById('newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('newsletter-email').value;
        
        try {
            const response = await fetch('subscribe.php', {
                method: 'POST',
                body: JSON.stringify({ email }),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            
            const data = await response.json();
            alert(data.message);
        } catch (error) {
            console.error('Error:', error);
        }
    });
}

// Mobile menu toggle
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
    });
}

// Donation form validation
function validateDonationForm() {
    const amount = document.getElementById('donation-amount').value;
    const name = document.getElementById('donor-name').value;
    const email = document.getElementById('donor-email').value;
    
    if (!amount || !name || !email) {
        alert('Mohon lengkapi semua field');
        return false;
    }
    
    if (isNaN(amount) || amount <= 0) {
        alert('Mohon masukkan jumlah donasi yang valid');
        return false;
    }
    
    return true;
}
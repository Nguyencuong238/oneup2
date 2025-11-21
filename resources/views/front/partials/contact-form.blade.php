<section class="contact-form-section" id="consultation">
    <div class="container">
        <div class="contact-form-wrapper">
            <h2 class="contact-form-title">NHẬN TƯ VẤN NGAY</h2>

            <form id="contactForm" class="contact-form">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact_name">Họ & Tên</label>
                        <input type="text"
                               id="contact_name"
                               name="name"
                               class="form-control"
                               placeholder="Họ & Tên"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="contact_phone">Số điện thoại</label>
                        <input type="tel"
                               id="contact_phone"
                               name="phone"
                               class="form-control"
                               placeholder="Số điện thoại"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contact_email">Email <span class="required">*</span></label>
                    <input type="email"
                           id="contact_email"
                           name="email"
                           class="form-control"
                           placeholder="Nhập email của bạn"
                           required>
                </div>

                <div class="form-group">
                    <label for="contact_message">Lời nhắn</label>
                    <textarea id="contact_message"
                              name="message"
                              class="form-control"
                              rows="4"
                              placeholder="Lời nhắn"></textarea>
                </div>

                <div class="form-message" id="contactFormMessage"></div>

                <button type="submit" class="btn-submit">GỬI YÊU CẦU</button>

                <p class="privacy-notice">* Mọi thông tin của bạn đều được cam kết bảo mật</p>
            </form>
        </div>
    </div>
</section>

<style>
.contact-form-section {
    padding: 60px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 0;
}

.contact-form-wrapper {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.contact-form-title {
    text-align: center;
    font-size: 32px;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 40px;
    letter-spacing: 1px;
}

.contact-form .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.contact-form .form-group {
    margin-bottom: 20px;
}

.contact-form label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.contact-form label .required {
    color: #e74c3c;
}

.contact-form .form-control {
    width: 100%;
    padding: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.contact-form .form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.contact-form .form-control::placeholder {
    color: #aaa;
}

.contact-form textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.contact-form .form-message {
    margin: 20px 0;
    padding: 15px;
    border-radius: 8px;
    display: none;
}

.contact-form .form-message.show {
    display: block;
}

.contact-form .form-message .contact_success {
    color: #27ae60;
    font-weight: 500;
}

.contact-form .form-message .contact_error {
    color: #e74c3c;
    font-weight: 500;
}

.contact-form .btn-submit {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 10px;
}

.contact-form .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.contact-form .btn-submit:active {
    transform: translateY(0);
}

.contact-form .btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.contact-form .privacy-notice {
    text-align: center;
    font-size: 13px;
    color: #666;
    margin-top: 20px;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .contact-form-wrapper {
        padding: 30px 20px;
    }

    .contact-form-title {
        font-size: 24px;
        margin-bottom: 30px;
    }

    .contact-form .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .contact-form .btn-submit {
        padding: 15px;
        font-size: 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const messageDiv = document.getElementById('contactFormMessage');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = form.querySelector('.btn-submit');
            const formData = new FormData(form);

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'ĐANG GỬI...';

            // Hide previous messages
            messageDiv.classList.remove('show');
            messageDiv.innerHTML = '';

            fetch('{{ route("contacts.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                messageDiv.innerHTML = data.msg;
                messageDiv.classList.add('show');

                if (data.success) {
                    form.reset();
                    // Scroll to message
                    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }

                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'GỬI YÊU CẦU';
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.innerHTML = '<span class="contact_error">Có lỗi xảy ra. Vui lòng thử lại sau.</span>';
                messageDiv.classList.add('show');

                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'GỬI YÊU CẦU';
            });
        });
    }
});
</script>

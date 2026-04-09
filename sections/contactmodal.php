<!-- PROJECT MODAL -->
<div class="project-modal" id="projectModal">
    <div class="project-modal-overlay"></div>

    <div class="project-modal-box">
        <button class="modal-close" id="closeProjectModal">&times;</button>

        <h3>Start Your Project</h3>
        <p class="modal-subtitle">Tell us a bit about your idea</p>
        <div class="form-success-msg" id="formSuccessMsg" style="display:none;">
            🎉 <b>Thank you!</b><br>
            Your request has been received.<br>
            We’ll contact you shortly 😊
        </div>

        <form class="project-form" id="projectForm">
            <input type="hidden" name="project_form" value="1">
            <!-- Honeypot anti-spam field -->
            <input type="text" name="website" tabindex="-1" autocomplete="off" style="display:none">
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Business Name</label>
                <input type="text" name="business_name">
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone" required>
            </div>

            <div class="form-group">
                <label>Service Type</label>
                <select name="service_type" required>
                    <option value="">Select a service</option>
                    <option>Design</option>
                    <option>Video Production</option>
                    <option>Editing</option>
                    <option>Branding</option>
                    <option>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Preferred Calling Time</label>
                <select name="preferred_time">
                    <option value="">Anytime</option>
                    <option>Morning (10am–12pm)</option>
                    <option>Afternoon (12pm–4pm)</option>
                    <option>Evening (4pm–7pm)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" rows="4"></textarea>
            </div>

            <button type="submit" class="btn-primary w-100">
                Submit Request
            </button>
        </form>


    </div>
</div>
<style>
    /* ===== PROJECT MODAL ===== */
    .project-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
    }

    .project-modal.active {
        display: block;
    }

    /* Overlay */
    .project-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .75);
        backdrop-filter: blur(6px);
    }

    /* Modal Box */
    .project-modal-box {
        position: relative;
        max-width: 480px;
        margin: 6vh auto;
        background: #fff;
        border-radius: 22px;
        padding: 35px 30px 30px;
        box-shadow: 0 40px 120px rgba(0, 0, 0, .6);
        animation: modalFadeUp .45s ease;
    }

    /* Close */
    .modal-close {
        position: absolute;
        top: 16px;
        right: 18px;
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #555;
    }

    /* Headings */
    .project-modal-box h3 {
        font-size: 26px;
        margin-bottom: 6px;
        color: #4f6df5;
    }

    .modal-subtitle {
        font-size: 14px;
        color: #666;
        margin-bottom: 22px;
    }

    /* Form */
    .project-form .form-group {
        margin-bottom: 16px;
    }

    .project-form label {
        font-size: 13px;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: #333;
    }

    .project-form input,
    .project-form select,
    .project-form textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid #ddd;
        font-size: 14px;
        outline: none;
    }

    .project-form input:focus,
    .project-form select:focus,
    .project-form textarea:focus {
        border-color: #4f6df5;
    }

    /* Full width button */
    .w-100 {
        width: 100%;
        margin-top: 10px;
    }

    .form-success-msg {
        background: #f0f7ff;
        border: 1px solid #cfe2ff;
        color: #084298;
        padding: 16px;
        border-radius: 14px;
        text-align: center;
        font-size: 15px;
        margin-bottom: 20px;
    }

    /* Animation */
    @keyframes modalFadeUp {
        from {
            transform: translateY(40px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Mobile */
    @media (max-width: 600px) {
        .project-modal-box {
            margin: 10vh 15px;
            padding: 28px 22px;
        }
    }
</style>
<script>
    document.addEventListener('click', function (e) {

        if (e.target.closest('.open-project-modal')) {
            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                event: 'project_modal_open',
                page_path: window.location.pathname
            });
             trackEvent('project_modal_open');
            const modal = document.getElementById('projectModal');
            const form = document.getElementById('projectForm');
            const success = document.getElementById('formSuccessMsg');

            modal.classList.add('active');

            // RESET STATE FOR NEXT OPEN ✅
            form.style.display = '';
            success.style.display = 'none';

            document.body.style.overflow = 'hidden';
        }

        if (
            e.target.closest('#closeProjectModal') ||
            e.target.classList.contains('project-modal-overlay')
        ) {
            document.getElementById('projectModal').classList.remove('active');
            document.body.style.overflow = '';
        }

    });

</script>
<script>
    document.getElementById('projectForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const btn = form.querySelector('button');

        btn.innerHTML = 'Submitting...';
        btn.disabled = true;

        fetch('./ajax/save-project-lead2.php', {
            method: 'POST',
            body: new FormData(form)
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.dataLayer = window.dataLayer || [];
                    dataLayer.push({
                        event: 'lead_submit',
                        lead_type: 'project_form',
                        service_type: form.querySelector('[name="service_type"]').value,
                        page_path: window.location.pathname
                    });
                    trackEvent('project_form_submit', {
            service_type: form.service_type.value || null
        });
                    form.style.display = 'none';
                    document.getElementById('formSuccessMsg').style.display = 'block';
                    form.reset();
                } else {
                    alert('Submission failed. Please try again.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Server error. Please try later.');
            })
            .finally(() => {
                btn.innerHTML = 'Submit Request';
                btn.disabled = false;
            });
    });
</script>
<script>
    let projectFormStarted = false;

    document.getElementById('projectForm').addEventListener('input', function () {
        if (!projectFormStarted) {
            projectFormStarted = true;

            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                event: 'project_form_start',
                page_path: window.location.pathname
            });
        }
    });
</script>
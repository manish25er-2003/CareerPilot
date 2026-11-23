@php
$toastMessages = [];

if (session('success')) {
$toastMessages[] = ['type' => 'success', 'message' => session('success')];
}
if (session('error')) {
$toastMessages[] = ['type' => 'error', 'message' => session('error')];
}
if (session('warning')) {
$toastMessages[] = ['type' => 'warning', 'message' => session('warning')];
}

$statusMessages = [
'profile-updated' => ['type' => 'success', 'message' => 'Profile updated successfully.'],
'password-updated' => ['type' => 'success', 'message' => 'Password changed successfully.'],
'verification-link-sent' => ['type' => 'success', 'message' => 'A new verification link was sent to your email.'],
'passwords.sent' => ['type' => 'success', 'message' => 'Password reset link sent. Check your email.'],
'passwords.reset' => ['type' => 'success', 'message' => 'Password changed successfully. You can now sign in.'],
];

if (session('status') && isset($statusMessages[session('status')])) {
$toastMessages[] = $statusMessages[session('status')];
} elseif (session('status') && is_string(session('status'))) {
$status = session('status');
$toastMessages[] = str_contains($status, 'throttle')
? ['type' => 'warning', 'message' => $status]
: ['type' => 'success', 'message' => $status];
}

foreach ($errors->all() as $error) {
$toastMessages[] = ['type' => 'error', 'message' => $error];
}
@endphp

<div class="careerpilot-toast-region" id="careerpilotToastRegion" role="region" aria-label="Notifications" aria-live="polite"></div>

<script>
    (function() {
        const region = document.getElementById('careerpilotToastRegion');
        if (!region) return;

        const icons = {
            success: '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9.2 16.2l-4-4 1.6-1.6 2.4 2.4 7.9-7.9L18.7 6.7z"/></svg>',
            error: '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M11 15h2v2h-2zm0-8h2v6h-2zm1-5a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z"/></svg>',
            warning: '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M11 7h2v6h-2zm0 8h2v2h-2zm1-13 10 18H2zm0 4.1L5.2 20h13.6z"/></svg>'
        };

        const messages = {
            !!json_encode($toastMessages, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!
        };
        const seen = new Set();

        function showToast(type, message) {
            const safeType = ['success', 'error', 'warning'].includes(type) ? type : 'success';
            const text = String(message || '').trim();
            if (!text) return;

            const key = safeType + ':' + text;
            if (seen.has(key)) return;
            seen.add(key);

            const toast = document.createElement('div');
            toast.className = 'careerpilot-toast careerpilot-toast--' + safeType;
            toast.setAttribute('role', safeType === 'error' ? 'alert' : 'status');
            toast.innerHTML = '<span class="careerpilot-toast__icon">' + icons[safeType] + '</span>' +
                '<span class="careerpilot-toast__message"></span>' +
                '<button type="button" class="careerpilot-toast__close" aria-label="Dismiss notification">×</button>';
            toast.querySelector('.careerpilot-toast__message').textContent = text;

            region.appendChild(toast);
            requestAnimationFrame(function() {
                toast.classList.add('is-visible');
            });

            let timer = window.setTimeout(function() {
                dismiss(toast);
            }, safeType === 'error' ? 6500 : 5000);

            function dismiss(target) {
                window.clearTimeout(timer);
                target.classList.remove('is-visible');
                window.setTimeout(function() {
                    target.remove();
                }, 220);
            }

            toast.querySelector('.careerpilot-toast__close').addEventListener('click', function() {
                dismiss(toast);
            });
        }

        messages.forEach(function(item) {
            showToast(item.type, item.message);
        });

        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                if (form.dataset.submitting === 'true') {
                    return;
                }

                form.dataset.submitting = 'true';
                form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(function(button) {
                    if (button.disabled) return;
                    button.disabled = true;
                    button.dataset.originalText = button.textContent || '';
                    if (button.tagName === 'BUTTON' && button.textContent.trim()) {
                        button.textContent = 'Please wait...';
                    }
                });
            });
        });

        window.addEventListener('pageshow', function() {
            document.querySelectorAll('form[data-submitting="true"]').forEach(function(form) {
                delete form.dataset.submitting;
                form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(function(button) {
                    button.disabled = false;
                    if (button.dataset.originalText) {
                        button.textContent = button.dataset.originalText;
                        delete button.dataset.originalText;
                    }
                });
            });
        });
    })();
</script>
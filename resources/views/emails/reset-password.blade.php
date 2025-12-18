<p>Halo,</p>

<p>Kami menerima permintaan untuk reset password akun Anda.</p>

<p>Silakan klik link berikut untuk membuat password baru:</p>

<p>
    <a href="{{ url('/reset-password/'.$token.'?email='.urlencode($email)) }}">
        Reset Password
    </a>
</p>

<p>Link ini berlaku selama 60 menit.</p>

<p>Jika Anda tidak meminta reset password, abaikan email ini.</p>

<p>Salam,<br>Eventify</p>

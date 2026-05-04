<?php
$page_title = 'Contact';
require_once 'includes/header.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'includes/db.php';
    $db = getDB();
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $stmt = $db->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        if ($stmt->execute()) {
            $success = "Thank you! Your message has been sent. We'll get back to you soon.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
        $db->close();
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<div class="page-header">
    <h1>Contact Us</h1>
    <p>We'd love to hear from you. Reach out anytime.</p>
</div>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="contact-form-wrapper">
                    <h3 class="mb-4">Send Us a Message</h3>

                    <?php if ($success): ?>
                    <div class="alert-success-custom mb-4">
                        <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                    <div class="alert alert-danger mb-4"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="How can we help?">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Message *</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="info-card">
                    <h4 class="mb-4">Visit Us</h4>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div><strong>Address</strong><br>123 Coffee Lane, Riyadh, Saudi Arabia</div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <div><strong>Opening Hours</strong><br>Mon–Fri: 7:00 AM – 10:00 PM<br>Sat–Sun: 8:00 AM – 11:00 PM</div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div><strong>Phone</strong><br>+966 50 123 4567</div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div><strong>Email</strong><br>hello@greencoffee.sa</div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-white rounded-4 border">
                    <h6 class="mb-3">Follow Us</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-secondary rounded-circle" style="width:42px;height:42px;display:flex;align-items:center;justify-content:center;"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-outline-secondary rounded-circle" style="width:42px;height:42px;display:flex;align-items:center;justify-content:center;"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="btn btn-outline-secondary rounded-circle" style="width:42px;height:42px;display:flex;align-items:center;justify-content:center;"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-outline-secondary rounded-circle" style="width:42px;height:42px;display:flex;align-items:center;justify-content:center;"><i class="fab fa-snapchat"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>

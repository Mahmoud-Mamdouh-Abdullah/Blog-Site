<?php
require_once('./config.php');
require_once(BASE_PATH . '/layout/header.php');
?>

<div class="container main-container">
    <div>
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact" />
    </div>
    <form method="GET" action="<?= BASE_URL . 'mail.php'?>">
        <h3 class="mb-3">Drop Us a Message</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                </div>
                <div class="form-group">
                    <input type="text" required name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                </div>
                <div class="form-group">
                    <input type="text" required name="txtSubject" class="form-control" placeholder="Your Mail Subject *" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary mt-3" value="Send Message" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="txtMsg" required class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once(BASE_PATH . '/layout/footer.php'); ?>
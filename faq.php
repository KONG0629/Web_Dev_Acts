<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions</title>
    <link rel="stylesheet" href="style/faqs.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">

    


    <?php include 'headerall.php'; ?>





        <!--contentfirst-->
        <div class="content">

            <div class="blueShape">
                <h1>Frequently Asked Questions</h1>
            </div>
        
            <div class="tiltedBlueShape"></div>
        </div>
    <!--contentfirst-->


    <!-- Content Second-->
    <div class="wrapper">
        <div class="left">
            <div class="text1">
                <div class="navigation-header">
                    <h3>Navigation</h3>
                </div>
                <div class="navigation-buttons">
                    <a href="#nav-q01" class="navigation-button"><p>Can I contribute to the blog?</p></a>
                    <a href="#nav-q02" class="navigation-button"><p>What is this blog about?</p></a>
                    <a href="#nav-q03" class="navigation-button"><p>Do you have a mobile app?</p></a>
                    <a href="#nav-q04" class="navigation-button"><p>Can I report an issue with the website?</p></a>
                    <a href="#nav-q05" class="navigation-button"><p>How can I contact you?</p></a>
                    <a href="#nav-q06" class="navigation-button"><p>Can I follow your blog on social media?</p></a>
                    <a href="#nav-q07" class="navigation-button"><p>How can I support the blog?</p></a>
                    <a href="#nav-q08" class="navigation-button"><p>What should I do if I forgot my account password?</p></a>
                    <a href="#nav-q09" class="navigation-button"><p>How do I submit feedback or report an error in a post?</p></a>
                    <a href="#nav-q10" class="navigation-button"><p>Are there video or podcast versions of the articles?</p></a>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="text2">
                <h4 id="nav-q01">Can I contribute to the blog?</h4>
                <p>
                    Yes! We welcome guest contributors who share our passion for topics. Please visit our “Create Now” page for more information.
                </p>
                <h4 id="nav-q02">What is this blog about?</h4>
                <p>
                    This blog covers topics including [topics you cover, e.g., travel, tech, personal finance, etc.], offering tips, guides, and 
                    insights to help readers make informed decisions and find inspiration.
                </p>
                <h4 id="nav-q03">Do you have a mobile app?</h4>
                <p>
                    Currently, we don't have a dedicated app, but our blog is optimized for mobile viewing. You can easily read our posts from any 
                    smartphone or tablet browser.
                </p>
                <h4 id="nav-q04">Can I report an issue with the website?</h4>
                <p>
                    Yes, if you encounter any technical issues or broken links, please contact us via our Contact page. We appreciate your help in 
                    making the site better!
                </p>
                <h4 id="nav-q05">How can I contact you?</h4>
                <p>
                    You can reach out to us via our help center page, where you'll find a form to send us a message directly. We aim to respond 
                    within 48 hours.
                </p>
                <h4 id="nav-q06">Can I follow your blog on social media?</h4>
                <p>
                    Absolutely! We're active on platforms like Instagram, Twitter, and Facebook. Follow us for updates, highlights, and 
                    behind-the-scenes content.
                </p>
                <h4 id="nav-q07">How can I support the blog?</h4>
                <p>
                    If you enjoy our content, you can support us by sharing our posts, leaving comments, or engaging with our content on social 
                    media. Some readers also choose to donate or buy merchandise if we offer these options.
                </p>
                <h4 id="nav-q08">What should I do if I forgot my account password?</h4>
                <p>
                    If you have an account and forget your password, click on the “Forgot Password?” link on the login page. Follow the 
                    instructions to reset it securely.
                </p>
                <h4 id="nav-q09">How do I submit feedback or report an error in a post?</h4>
                <p>
                    We appreciate your feedback! You can report errors or suggest improvements by contacting us through our Contact page or by 
                    emailing Us below. We aim to review all feedback quickly.
                </p>
                <h4 id="nav-q10">Are there video or podcast versions of the articles?</h4>
                <p>
                    Currently, we mainly offer written articles. However, we are exploring other formats! Let us know if you'd be interested in video 
                    or podcast content by filling out our reader survey.
                </p>
            </div>
        </div>
    </div>
    <!-- Content Second -->




    
    <?php include 'footer.php'; ?>





    </div>


    <script src="script/sidebar.js"></script>

    
</body>
</html>
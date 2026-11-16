<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="header_nav">
            <div class="logo">
                <a href="index.php"><img src="image/MLogo.png"></a>
            </div>
            <div class="nav">
                <form>
                    <input type="text" name="search" id="search" class="searchBox" placeholder="Search">
                    <button type="submit" class="searchIcon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="management">
            <h1>Admin Dashboard</h1>
            <hr>
            <div class="managementFunctions">
                <div class="functionsLeft">
                    <button type="button" class="smallNavigationButton">Queue</button>
                    <button type="button" class="smallNavigationButton">Reported</button>
                    <button type="button" class="smallNavigationButton">Removed</button>
                    <button type="button" class="smallNavigationButton">Unmoderated</button>
                </div>
                <div class="functionsRight">
                    <a href="discovery.php"><button type="button" class="smallNavigationButton">Post&ensp;<i class="fa-solid fa-shapes"></i></button></a>
                </div>
            </div>
            <hr>
            <div class="postContainer">
                <div class="postTextContainer">
                    <p><span class="postTitle">Basics of Being a Pirate</span> • 1 day ago</p>
                    <p>
                        Being a pirate requires dedication of being one no matter the challenges that may come in your way 
                        as climbing your way from being an aspiring pirate to a powerful and respected pirate of the sea. 
                        In this post, I will guide you and show you the basics of being a pirate.
                    </p>
                </div>
                <div class="interractiveIcons">
                    <div class="blueIcons">
                        <p>
                            <i class="fa-regular fa-eye"></i> 114.8k&ensp;
                            <i class="fa-regular fa-comment"></i> 6.2k
                        </p>
                    </div>
                    <div class="redIcons">
                        <p>
                            <i class="fa-regular fa-eye-slash"></i>&ensp;
                            <i class="fa-regular fa-trash-can"></i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="postContainer">
                <div class="postTextContainer">
                    <p><span class="postTitle">Tips on Finding a Crew</span> • 3 day ago</p>
                    <p>
                        Being a pirate is already fun on its own but it will be more fun when you have 
                        crewmates who will come with your journey of being a great pirate. I will show 
                        you what to do in order to find people who will join your crew.
                    </p>
                </div>
                <div class="interractiveIcons">
                    <div class="blueIcons">
                        <p>
                            <i class="fa-regular fa-eye"></i> 97.8k&ensp;
                            <i class="fa-regular fa-comment"></i> 5.6k
                        </p>
                    </div>
                    <div class="redIcons">
                        <p>
                            <i class="fa-regular fa-eye-slash"></i>&ensp;
                            <i class="fa-regular fa-trash-can"></i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="postContainer">
                <div class="postTextContainer">
                    <p><span class="postTitle">What to Expect in the Sea While Sailing?</span> • 3 day ago</p>
                    <p>
                        The sea is your home and also the place with endless adventures that 
                        is waiting for you to explore and discover many treasures and mysteries. 
                        The sea is also home to many legends and myths waiting to be witnessed by 
                        brave pirates who sails to the seas.
                    </p>
                </div>
                <div class="interractiveIcons">
                    <div class="blueIcons">
                        <p>
                            <i class="fa-regular fa-eye"></i> 97.8k&ensp;
                            <i class="fa-regular fa-comment"></i> 5.6k
                        </p>
                    </div>
                    <div class="redIcons">
                        <p>
                            <i class="fa-regular fa-eye-slash"></i>&ensp;
                            <i class="fa-regular fa-trash-can"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        
        <?php include 'footer.php'; ?>

        
    </div>

    
</body>
</html>
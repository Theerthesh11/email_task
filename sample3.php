<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Side Bar Tabs</title>
    <style>
        /* Basic styling for the sidebar */
        .sidebar {
            width: 200px;
            background-color: #F2F2F2;
            padding: 20px;
            float: left;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        /* Style for the highlighted tab */
        .sidebar ul li a.active {
            font-weight: bold;
            color: #FF0000;
            /* Change color as needed */
        }

        /* Styling for the content area */
        .content {
            margin-left: 220px;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <ul>
            <li><a href="?tab=home<?= isset($_GET['tab']) && $_GET['tab'] === 'home' ? '" class="active"' : '' ?>">Home</a></li>
            <li><a href="?tab=career<?= isset($_GET['tab']) && $_GET['tab'] === 'career' ? '" class="active"' : '' ?>">Career</a></li>
            <li><a href="?tab=about<?= isset($_GET['tab']) && $_GET['tab'] === 'about' ? '" class="active"' : '' ?>">About Us</a></li>
        </ul>
    </div>
    <div class="content">
        <?php
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'home';
        switch ($tab) {
            case 'home':
                echo '<h2>Home Content</h2><p>This is the content for the Home tab.</p>';
                break;
            case 'career':
                echo '<h2>Career Content</h2><p>This is the content for the Career tab.</p>';
                break;
            case 'about':
                echo '<h2>About Us Content</h2><p>This is the content for the About Us tab.</p>';
                break;
            default:
                echo '<h2>Home Content</h2><p>This is the content for the Home tab.</p>';
                break;
        }
        ?>
    </div>
</body>

</html> 
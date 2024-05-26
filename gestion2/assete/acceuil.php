<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intern Management</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('https://i.etsystatic.com/30393702/r/il/78f9b8/3143502690/il_1588xN.3143502690_8nx6.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-align: center;
        }

        header {
            padding: 20px;
            background: rgba(0, 140, 255, 0.5);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh;
        }

        .welcome {
            background: rgba(0, 140, 255, 0.5);
            padding: 40px;
            border-radius: 10px;
        }

        .welcome h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .welcome p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background: #000091;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #2980b9;
        }

        footer {
            padding: 10px;
            background:  rgba(0, 140, 255, 0.5);
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <h1>Intern Management</h1>
    </header>
    <main>
        <section class="welcome">
            <h2>Welcome to the Intern Management System</h2>
            <p>Manage your interns,departement and internships</p>
            <a href="./../login.php" class="btn">login</a>
        </section>
    </main>
    
</body>
</html>
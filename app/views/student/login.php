<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/thoth_brief/public/css/style.css">
</head>
<body>
    <h2>Login</h2>

    <?php if(!empty($error)): ?>
        <p style="color: red"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="enter your email" required>
            <input type="password" name="password" placeholder="password" required>
            <button type="submit">Login</button>
            <a href="/thoth_brief/public/student/register">Register</a>
        </form>
        
</body>
</html>
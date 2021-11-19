<?php
include_once "header.php"
?>
    <link rel="stylesheet" href="styles.css">

    <main class="main-image-container">
        <div>Sign up and start learning vocabulary today!</div>
        <?php if (isset($_SESSION["userid"])): ?>
            <a class="link inviting-link" href="profile.php">Let's Go!</a>
        <?php else: ?>
            <a class="link inviting-link" href="signup.php">Let's Go!</a>
        <?php endif; ?>
        <div style="background: orange; padding: 40px; border-radius: 5px; margin: 30px">
            <h1>This is a work in progress:</h1>
            <ul>
                <li>Styling (mostly coloring) is not final, layout is close to the final version</li>
                <li>Features that are yet to be implemented:
                <li>Profile updating (email, password, name, email, username, ...)</li>
                <li>Word filtering inside the set by the first letter</li>
                <li>Word sorting inside the set by date added</li>
                <li>Vocabulary set sorting by date added</li>
                <li>Importing word sets from a text file</li>
                <li>Front-end validation</li>
                <li>* Word quizzes based on random X words from a given set (if I have enough time) *</li>
            </ul>
        </div>
    </main>

<?php
include_once "footer.php"
?>
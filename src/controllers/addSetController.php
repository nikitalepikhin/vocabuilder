<?php

session_start();

function addSet($conn, $userId, $setName)
{
    $sql = "insert into VOCAB_SET (VOCAB_SET_USER_ID, VOCAB_SET_NAME) values (?, ?)";

    if (!$stmt = mysqli_prepare($conn, $sql)) {
        header("Location: ../profile/profile.php?error=internalerror");
        exit();
    }

    if (!mysqli_stmt_bind_param($stmt, 'is', $userId, $setName)) {
        header("Location: ../profile/profile.php?error=internalerror");
        exit();
    }

    if (!mysqli_stmt_execute($stmt)) {
        header("Location: ../profile/profile.php?error=internalerror");
        exit();
    }
}

if (isset($_POST["submit"])) {
    $setName = $_POST["setName"];
    $userId = $_SESSION["userid"];

    require_once "../database/db.conn.php";
    require_once "../utils/utils.php";

    if (isset($conn)) {
        if (empty($setName)) {
            header("Location: ../profile/profile.php?error=emptySet");
            exit();
        }

        addSet($conn, $userId, $setName);
        mysqli_close($conn);
        header("Location: ../profile/profile.php?error=none");
    }

} else {
    header("Location: ../login/login.php?error=invalidsubmit");
    exit();
}
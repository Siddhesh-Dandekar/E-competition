<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die('You are not logged in.');
}

// Connect to the database
require_once "../config.php";


// Get the messages
$result = $conn->query("SELECT chat_messages.*, users.user_name FROM `chat_messages` INNER JOIN `users` ON chat_messages.user_id = users.user_id ORDER BY `timestamp` ASC");

$messages = array();
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}


// If form is submitted, insert a new message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO `chat_messages` (`user_id`, `message`) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['message']]);
    header('Location: chatroom.php');
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Chatroom</title>

    <style>
        .timestamp {
            font-size: 0.8em;
            color: #888;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #E5DDD5;
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        .my-message {
            margin: 10px;
            padding: 10px;
            background-color: #DCF8C6;
            width: fit-content;
            border-radius: 10px;
            order: 2;
            align-self: flex-end;
        }

        .other-message {
            margin: 10px;
            padding: 10px;
            background-color: #FFFFFF;
            width: fit-content;
            border-radius: 10px;
            order: 1;
            align-self: flex-start;
        }

        form {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            width: 100%;
            background-color: white;
        }

        .input-field {
            flex: 1;
            padding: 10px;
            border-radius: 30px;
            border: none;
            margin-right: 10px;
            background-color: #F0F0F0;
        }

        button {
            background-color: #128C7E;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            width: 70px;
        }

        .chat-messages {
            max-height: 500px;
            /* Adjust this value to your needs */
            overflow-y: auto;
        }
    </style>



</head>

<body>
    <header class="text-gray-400 bg-black body-font">
        <div class="container mx-auto flex flex-wrap p-3 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                <img class="w-15 h-16 text-white bg-indigo-500 rounded-full" src="/img/loadout-logo.jpg" alt="">
                <span class="ml-3 text-3xl" style="font-family: 'Alkatra', cursive;">E-Sports Competition</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a href="category.php" class="mr-5 hover:text-white text-2xl"
                    style="font-family: 'Alkatra', cursive;">Home</a>
                <a href="profile.php" class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">My Profile</a>
                <a href="../logout.php" class="mr-5 hover:text-white text-2xl"
                    style="font-family: 'Alkatra', cursive;">Logout</a>
            </nav>
        </div>
    </header>

    <section>
        <div class="chat-messages" id="chat-messages">
            <?php foreach ($messages as $message): ?>
                <div class="<?= ($message['user_id'] == $_SESSION['user_id']) ? 'my-message' : 'other-message' ?>">
                    <strong><?= htmlspecialchars($message['user_name']) ?></strong>
                    <p><?= htmlspecialchars($message['message']) ?></p>
                    <span class="timestamp"><?= date('H:i', strtotime($message['timestamp'])) ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <form method="post">
            <textarea placeholder="Type a message here..." class="input-field" name="message" required
                autocomplete="off"></textarea>
            <button type="submit"><i class="fas fa-paper-plane fa-lg"></i></button>
        </form>

    </section>

    <script>
        window.onload = function () {
            var chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>

</body>

</html>
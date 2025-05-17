<?php
// JSON файлынан маалыматтарды алуу
$dataFile = 'data.json';
$dataList = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// POST сурам иштетүү
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $index = $_POST['index'];
        if (isset($dataList[$index])) {
            unset($dataList[$index]);
            $dataList = array_values($dataList); // Индекстерди кайра иреттөө
            file_put_contents($dataFile, json_encode($dataList, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }

    if (isset($_POST['update'])) {
        $index = $_POST['index'];
        header("Location: update.php?index=$index");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Анкета катышуучулар</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fcd2e2;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .entry {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .entry img {
            width: 200px;
            height: auto;
            border-radius: 10px;
        }

        .info {
            flex: 1;
            margin-left: 20px;
        }

        .qr {
            text-align: center;
        }

        form button {
            background-color: #ff4081;
            border: none;
            color: white;
            padding: 8px 16px;
            margin: 5px 5px 0 0;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #e73370;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Катышуучулардын анкетасы</h2>
    <div class="container">
        <?php foreach ($dataList as $index => $entry): ?>
            <?php if (empty($entry['photo'])) continue; ?>
            <div class="entry">
                <!-- Фото -->
                <img src="<?= htmlspecialchars($entry['photo']) ?>" alt="Фото">

                <!-- Маалымат жана кнопкалар -->
                <div class="info">
                    <p><strong><?= htmlspecialchars($entry['name']) ?></strong></p>
                    <p>Жашы: <?= htmlspecialchars($entry['age']) ?></p>
                    <p><?= htmlspecialchars($entry['about']) ?></p>

                    <!-- Кнопкалар -->
                    <form method="post">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" name="delete">Өчүрүү</button>
                        <button type="submit" name="update">Жаңыртуу</button>
                    </form>
                </div>

                <!-- WhatsApp жана QR код -->
                <div class="qr">
                    <p><a href="https://wa.me/<?= urlencode($entry['whatsapp']) ?>" target="_blank">
                        <?= htmlspecialchars($entry['whatsapp']) ?>
                    </a></p>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=https://wa.me/<?= urlencode($entry['whatsapp']) ?>&size=150x150" alt="QR код">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

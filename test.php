<?php
$testsDir = './data/';
if (empty($_GET) && empty($_POST)) {
    exit('Не переданы параметры');
}

if (!empty($_GET) && (!isset($_GET['id']) || empty($_GET['id']))) {
    exit('Передайте параметр id');

} elseif (!empty($_POST) && (!isset($_POST['testid']) || empty($_POST['testid']))) {

    exit('Тест прошёл не корректно');
}


if (!empty($_GET['id'])) {
    $NameFileTest = $_GET['id'];
} else {

    $NameFileTest = $_POST['testid'];
}
$testJson = file_get_contents($testsDir .$NameFileTest);

if ($testJson === false) {
    exit("Тест $NameFileTest не  найден!!!");
}
$testData = json_decode($testJson, true);
$testName = !empty($testData['title']) ? $testData['title'] : 'Тест без названия';
if (empty($testData['questions'])) {
    exit('В тесте нет вопросов :)');
}
$testQuestionsArray = $testData['questions'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
        <?php echo !empty($_GET) ? 'Тест - ' : 'Результат теста - ' ;?>
        <?php echo $NameFileTest; ?>
    </title>
</head>
<body>

<?php if (!empty($_GET)): ?>
    <h1>
        <?php echo $testName; ?>
    </h1>
    <form action="test.php" method="POST"> 
        <div><p>
            Ваше имя: <input name="user_name" type="text"><br />
            </p></div>
        <?php $fieldNamePrefix = 'v'; ?>
        <?php foreach ($testQuestionsArray as $questionCounter => $question): ?>
            <fieldset>
                <?php var_dump($questionCounter); if (isset($question['title'])): ?>
                    <h3>
                        <?php echo $question['title'] ?>
                    </h3>
                <?php else: ?>
                    <?php continue; ?>
                <?php endif; ?>
                <?php $fieldname = $fieldNamePrefix . (1 + $questionCounter); ?>
                <?php $answers = $question['answers']; ?>
                <?php foreach ($answers as $answer): ?>
                    <?php if (empty($answer['title'])): ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <?php $correct = isset($answer['correct']) && $answer['correct'] ? 'correct' : ''; ?>
                    <label>
                        <input type="radio" name="<?php echo $fieldname; ?>" value="<?php echo $correct; ?>">
                        <?php echo $answer['title'] ?>
                    </label>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <input type="hidden" name="testid" value="<?php echo $NameFileTest; ?>" />
        <input type="submit" placeholder="Отправить"/>
    </form>

<?php elseif (!empty($_POST)): ?>
    <h2>Результаты теста:</h2>
    <ul>
        <?php $resultCounter = 0; ?>
        <?php foreach ($_POST as $fieldName => $data): ?>
            <?php if ($fieldName === 'testid'): ?>
                <?php continue; ?>
            <?php endif; ?>
            <?php $questionTitle = $testQuestionsArray[$resultCounter++]['title']; ?>
            <?php $questionStatus = !empty($data); ?>
            <li>
                <?php echo $questionTitle . ' - ' . ($questionStatus ? 'Верно' : 'Не верно'); ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>
</body>
</html>
<?
include_once 'config.php';

// обработаем пришедший пост
$name = htmlspecialchars(strip_tags( $_POST['name'] ));
$mail = htmlspecialchars(strip_tags( $_POST['email'] ));
// тут ответы на вопросы
$answ = explode( '&', htmlspecialchars(strip_tags( $_POST['answers'] )) );
$questions = array();
$answers = array();

foreach ($answ as $val) {
	$temp = explode('=', $val);
	// получим id вопроса
	$questions []= substr($temp[0],1);
	// id ответа
	$answers []= $temp[1];
}

// СОХРАНИМ ЮЗЕРА И ЕГО РЕЗУЛЬТАТЫ В БАЗУ
// сохранение юзера

$q = $pdo->prepare("INSERT INTO `users` (`uname`,`email`) VALUES (?,?)");
$q->execute(array($name, $mail));
$lid = $pdo->lastInsertId();

//сохранение результатов
// подготовим запрос для prepare
$prepare = '';
$where = '';
$exec = array();

for ($i=0; $i < count($answers); $i++) { 
	$prepare .= $i ? ',('.$lid.',?,?,NOW())' : '('.$lid.',?,?,NOW())';
	$where .= $i ? ',?' : '?';
	$exec []= $questions[$i];
	$exec []= $answers[$i];
}

$q = $pdo->prepare("INSERT INTO `polls` (`user_id`,`question_id`,`answer_id`,`time`) VALUES ".$prepare);
$q->execute($exec);

// подсчитаем количество правильных ответов

$q = $pdo->prepare("SELECT SUM(`correct`) AS 'res' FROM `answers` WHERE `id` IN (".$where.")");
$q->execute($answers);
$result = $q->fetch();
$result = $result['res'];

$text = 'Результаты получены.<br>Вы ответили правильно на '.$result.' из '.$i.' вопросов.';

exit($text);
?>
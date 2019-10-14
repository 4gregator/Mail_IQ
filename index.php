<?
include_once 'config.php';
include 'head.php';
?>
<div class="container mt-5">
    <div class="container-fluid">
        <h1 class="text-center mb-4">ОПРОС</h1>
        <form name="poll">
            <div class="form-row">
                <div class="form-group col-9">
                <?
                // ВЫВОДИМ ОПРОС ИЗ БАЗЫ
                $q = $pdo->query("SELECT * FROM `questions` WHERE `test_id` = 1;");
                while ($quest = $q->fetch()) {
                ?>
                    <legend><?= $quest['question'] ?></legend>
                    <div class="col-12">
                    <?
                    // задаем вопросы
                    $q1 = $pdo->query("SELECT * FROM `answers` WHERE `question_id` = ".$quest['id']);
                    while ($res = $q1->fetch()) {
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q<?= $quest['id'] ?>" id="a<?= $res['id'] ?>" value="<?= $res['id'] ?>" required>
                            <label class="form-check-label" for="a<?= $res['id'] ?>">
                            <?= $res['answer'] ?>
                            </label>
                        </div>
                    <? } ?>
                    </div>
                <? } ?>
                </div>
                <div class="form-group col-3">
                    <label class="form-check-label" for="uname">Ваше имя</label>
                    <input id="uname" type="text" class="form-control" placeholder="Your Name" required>
                    <label class="form-check-label" for="email">Ваш email:</label>
                    <input id="email" type="email" class="form-control" placeholder="example@yahoo.com" required>
                    <input type="submit" id="sbmtPoll" class="btn btn-primary mt-2" value="Отправить">
                    <img id="preloader" class="mt-2" src="https://i.gifer.com/9wcA.gif" alt="loading">
                    <small id="error" class="text-danger d-block mt-1"></small>
                </div>
            </div>
        </form>
        <p id="answer"></p>
    </div>
</div>
<? include 'bottom.php' ?>
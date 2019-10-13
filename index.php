<?
include_once 'config.php';
include 'head.php';
?>
<div class="container mt-5">
    <div class="container-fluid">
        <h1 class="text-center mb-4">ОПРОС</h1>
        <form>
            <div class="form-row">
                <div class="form-group col-9">
                    TEst
                    TESDFSDFSDF
                </div>
                <div class="form-group col-3">
                    <label class="form-check-label" for="uname">Ваше имя</label>
                    <input id="uname" type="text" class="form-control" placeholder="Your Name" required>
                    <label class="form-check-label" for="email">Ваш email:</label>
                    <input id="email" type="email" class="form-control" placeholder="example@yahoo.com" required>
                    <input type="button" id="submit" class="btn btn-primary mt-2" value="Отправить">
                </div>
            </div>
        </form>
    </div>
</div>
<? include 'bottom.php' ?>
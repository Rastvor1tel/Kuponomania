<div class="modal fade slide left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel">Связаться с нами</h2>
            </div>
            <div class="modal-body">
                <p class="lead">В сообщении укажите наименование купона, по которому вы хотите задать вопрос.</p>
                <p></p>
                <form id="myForm" action="" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label for="name">Ваше имя*: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Имя*" value="" required>
                        <span class="error_name"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Ваш email*: </label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email*" value="" required>
                        <span class="error_email"></span>
                    </div>
                    <div class="form-group">
                        <label for="message">Ваш вопрос*: </label>
                        <textarea class="form-control" id="message" name="message" required=""></textarea>
                        <span class="error_message"></span>
                    </div>
                    <div class="form-group policy">
                        <label for="policy">
                            <input type="checkbox" name="policy" id="policy" class="form-control" value="" required="">
                            <span>Я согласен с <a href="/informacziya/polzovatelskoe-soglashenie/" target="_blank">правилами</a></span>
                            <span class="error_policy"></span>
                        </label>
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Отправить">
                </form>
            </div>
        </div>
    </div>
</div>
{include file="top.tpl"}
<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Добро пожаловать в систему!</h2>

                <p>
                    Наша программа призвана экономить ваши деньги на сборе показаний
                </p>
                <p>
                    Девиз нашей компании - Автоматизируй и зарабатывай!
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">

                    <form id='login-form' role='form' method='post' action=''>
                      {if !$valid}
                        <div class="alert alert-danger">
                          Не верно введен логин или пароль
                        </div>
                      {/if}
                      <fieldset>
                        <label>Логин</label>
                        <div class='form-group'>
                          <input class="form-control" name="login" type="text" autofocus="">
                        </div>
                        <div class='form-group'>
                          <label>Пароль</label>
                           <input class="form-control" name="password" type="password" value="">
                        </div>
                        <button type="submit" class="btn btn-info">Войти</button>
                      </fieldset>
                    </form>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 text-right">
               <small>Версия программы: {$version}</small>
            </div>
        </div>
    </div>



{include file="footer.tpl"}
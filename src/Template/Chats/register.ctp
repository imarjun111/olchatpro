<div class="container">
	<div class="login-container">
            <div id="output"></div>
            <div class="avatar"></div>
            <div class="form-box">
                <form method="post">
                    <input name="username" type="text" placeholder="username" required>
                    <input type="password" name ="password" placeholder="password" required>
                    <button class="btn btn-info btn-block login" type="submit">Register</button>
                </form>
                <a href="<?= $this->Url->build(['controller'=>'Chats','action'=>'login'])?>">Login Here</a>
            </div>
        </div>
        
</div>
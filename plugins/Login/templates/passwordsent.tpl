{include file="Login/templates/header.tpl"}

<div id="login">

{if $ErrorString}
	<div id="login_error"><strong>{'General_Error'|translate}</strong>: {$ErrorString}<br />
	{'Login_ContactAdmin'|translate}
	</div>
{else}
	<p class="message">
	{'Login_PasswordSent'|translate}
	</p>
{/if}

<p id="nav">
<a href="?module=Login&form_url={$urlToRedirect}" title="{'Login_LogIn'|translate}">{'Login_LogIn'|translate}</a>
</p>

</div>

</body>
</html>




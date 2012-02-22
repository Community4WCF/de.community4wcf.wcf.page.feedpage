{include file='header'}
<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/Suggestion.class.js"></script>
<div class="mainHeadline">
	<img src="{@RELATIVE_WCF_DIR}icon/feedpage{@$action|ucfirst}L.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wcf.acp.menu.link.content.feedpage.{@$action}{/lang}</h2>
		<p>{lang}wcf.acp.menu.link.content.feedpage.{@$action}.description{/lang}</p>
	</div>
</div>

{if $errorField}
	<p class="error">{lang}wcf.global.form.error{/lang}</p>
{/if}

{if $success|isset}
	<p class="success">{lang}wcf.acp.feedpage.{@$action}.success{/lang}</p>	
{/if}

<div class="contentHeader">
	<div class="largeButtons">
		<ul><li><a href="index.php?page=FeedPageList&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/feedpageM.png" alt="" title="{lang}wcf.acp.menu.link.content.feedpage.show{/lang}" /> <span>{lang}wcf.acp.menu.link.content.feedpage.show{/lang}</span></a></li></ul>
	</div>
</div>
<form method="post" action="index.php?form=FeedPage{@$action|ucfirst}">
	<div class="border content">
		<div class="container-1">      
            <fieldset>
				<legend>{lang}wcf.acp.feedpage.feed{/lang}</legend>
					
					<div class="formElement{if $errorField == 'title'} formError{/if}">
						<div class="formFieldLabel">
							<label for="title">{lang}wcf.acp.feedpage.title{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" id="title" name="title" value="{$title}" />
							{if $errorField == 'title'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="titleHelpMessage">
							{lang}wcf.acp.feedpage.title.description{/lang}
						</div>
						<script type="text/javascript">//<![CDATA[
							inlineHelp.register('title');
						//]]></script>
					</div>
					<div class="formElement{if $errorField == 'author'} formError{/if}">
						<div class="formFieldLabel">
							<label for="author">{lang}wcf.acp.feedpage.author{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" id="author" name="author" value="{$author}" />
							<script type="text/javascript">
								//<![CDATA[
								suggestion.enableMultiple(false);
								suggestion.init('author');
								//]]>
							</script>
							{if $errorField == 'author'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="authorHelpMessage">
							{lang}wcf.acp.feedpage.author.description{/lang}
						</div>
						<script type="text/javascript">//<![CDATA[
							inlineHelp.register('author');
						//]]></script>
					</div>										
					<div class="formElement{if $errorField == 'link'} formError{/if}">
						<div class="formFieldLabel">
							<label for="link">{lang}wcf.acp.feedpage.link{/lang}</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" id="link" name="link" value="{$link}" />
							{if $errorField == 'link'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="linkHelpMessage">
							{lang}wcf.acp.feedpage.link.description{/lang}
						</div>
						<script type="text/javascript">//<![CDATA[
							inlineHelp.register('link');
						//]]></script>
					</div>
					<div class="formElement{if $errorField == 'description'} formError{/if}">
						<div class="formFieldLabel">
							<label for="description">{lang}wcf.acp.feedpage.description{/lang}</label>
						</div>
						<div class="formField">
							<textarea id="description" name="description" cols="40" rows="10">{$description}</textarea>
							{if $errorField == 'description'}
								<p class="innerError">
									{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
								</p>
							{/if}
						</div>
						<div class="formFieldDesc hidden" id="descriptionHelpMessage">
							{lang}wcf.acp.feedpage.description.description{/lang}
						</div>
						<script type="text/javascript">//<![CDATA[
							inlineHelp.register('description');
						//]]></script>
					</div>
			</fieldset>
			
			{if $additionalFields|isset}{@$additionalFields}{/if}
		</div>
	</div>
		
	<div class="formSubmit">
		<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
		<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
		<input type="hidden" name="packageID" value="{@PACKAGE_ID}" />
 		{@SID_INPUT_TAG}
        {if $feedID|isset}<input type="hidden" name="feedID" value="{@$feedID}" />{/if}
 	</div>
</form>

{include file='footer'}
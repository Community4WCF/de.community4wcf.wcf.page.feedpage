{if FEEDPAGE_C4W_ENABLE_HEADLINE}<h4 class="subHeadline"><span>{lang}wcf.feedpage.index.headline{/lang}</span></h4>{/if}
{foreach from=$feedpageFeeds item=$feed}
	<div class="quoteBox">
		<div class="quoteHeader">
			<h3><img src="{icon}feedpageC4WS.png{/icon}" alt="" />
				{lang}wcf.feedpage.index.title{/lang}
			</h3>
		</div>
		<div class="quoteBody">
			{lang}{@$feed.description}{/lang}
		</div>
	</div>
{/foreach}
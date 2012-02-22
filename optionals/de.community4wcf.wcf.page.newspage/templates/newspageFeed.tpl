{include file="documentHeader"}
<head>
	<title>{lang}wcf.feedpage.newspage.title{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file='headInclude' sandbox=false}
	{if $this->user->getPermission('user.managepages.canViewFeedPage')}
	<link rel="alternate" type="application/rss+xml" href="index.php?page=FeedPage&amp;type=RSS2" title="News RSS2" />
	<link rel="alternate" type="application/atom+xml" href="index.php?page=FeedPage&amp;type=Atom" title="News Atom" />
	{/if}
	{if $newspagehead|isset}{@$newspagehead}{/if}
	<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/MultiPagesLinks.class.js"></script>
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>
{include file='header' sandbox=false}

<div id="main">
	<ul class="breadCrumbs">
		<li><a href="index.php?page=Index{@SID_ARG_2ND}"><img src="{icon}indexS.png{/icon}" alt="" /> <span>{lang}{PAGE_TITLE}{/lang}</span></a> &raquo;</li>
	</ul>

	<div class="mainHeadline">
		<img src="{icon}newspageL.png{/icon}" alt="" />
		<div class="headlineContainer">
			<h2>{lang}wcf.feedpage.newspage.title{/lang}</h2>
			<p>{lang}wcf.feedpage.newspage.description{/lang}</p>
		</div>
	</div>
	
	{if $userMessages|isset}{@$userMessages}{/if}
	
	<div class="border content">
		<div class="container-1">
			{if $newspageFeed1|isset}{@$newspageFeed1}{/if}
			{foreach from=$feedpageFeeds item=$feed}
				<div class="quoteBox">
					<div class="quoteHeader">
						<h3><img src="{icon}newspageS.png{/icon}" alt="" />
							{lang}wcf.feedpage.newspage.newstitle{/lang}
						</h3>
					</div>
					<div class="quoteBody">
						{lang}{@$feed.description}{/lang}
					</div>
				</div>
			{/foreach}
			{if $newspageFeed2|isset}{@$newspageFeed2}{/if}
			
			{if 'FEEDPAGE_BRANDINGFREE'|defined == false}
			<div> 
				<div>
					<div style="text-align: center;">{lang}wcf.global.page.newspage.copyright{/lang}</div>
				</div>
			</div>
			{/if}
		</div>
	</div>
</div>

{include file='footer' sandbox=false}
</body>
</html>
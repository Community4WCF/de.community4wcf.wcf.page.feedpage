{include file='header'}
<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/MultiPagesLinks.class.js"></script>

<div class="mainHeadline">
	<img src="{@RELATIVE_WCF_DIR}icon/feedpageL.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wcf.acp.menu.link.content.feedpage.show{/lang}</h2>
		<p>{lang}wcf.acp.menu.link.content.feedpage.show.description{/lang}</p>
	</div>
</div>

{if $deletedfeedID}
	<p class="success">{lang}wcf.acp.feedpage.delete.success{/lang}</p>	
{/if}

<div class="contentHeader">
	{pages print=true assign=pagesLinks link="index.php?page=FeedPageList&pageNo=%d&sortField=$sortField&sortOrder=$sortOrder&packageID="|concat:PACKAGE_ID:SID_ARG_2ND_NOT_ENCODED}
	
	{if $this->user->getPermission('admin.content.feedpage.feedpageadd')}
		<div class="largeButtons">
			<ul><li><a href="index.php?form=FeedPageAdd&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/feedpageAddM.png" alt="" title="{lang}wcf.acp.menu.link.content.feedpage.add{/lang}" /> <span>{lang}wcf.acp.menu.link.content.feedpage.add{/lang}</span></a></li></ul>
		</div>
	{/if}
</div>

{if $feedpageFeeds|count}
	<div class="border titleBarPanel">
		<div class="containerHead"><h3>{lang}wcf.acp.feedpage.count{/lang}</h3></div>
	</div>
	<div class="border borderMarginRemove">
		<table class="tableList">
			<thead>
				<tr class="tableHead">
					<th class="columnfeedID{if $sortField == 'feedID'} active{/if}" colspan="2"><div><a href="index.php?page=FeedPageList&amp;pageNo={@$pageNo}&amp;sortField=feedID&amp;sortOrder={if $sortField == 'feedID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.feedpage.feedID{/lang}{if $sortField == 'feedID'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
					<th class="columnfeedtitle{if $sortField == 'title'} active{/if}"><div><a href="index.php?page=FeedPageList&amp;pageNo={@$pageNo}&amp;sortField=title&amp;sortOrder={if $sortField == 'title' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.feedpage.title{/lang}{if $sortField == 'title'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
					<th class="columnfeedauthor{if $sortField == 'author'} active{/if}"><div><a href="index.php?page=FeedPageList&amp;pageNo={@$pageNo}&amp;sortField=author&amp;sortOrder={if $sortField == 'author' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.feedpage.author{/lang}{if $sortField == 'author'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
					<th class="columnfeedpubDate{if $sortField == 'pubDate'} active{/if}"><div><a href="index.php?page=FeedPageList&amp;pageNo={@$pageNo}&amp;sortField=pubDate&amp;sortOrder={if $sortField == 'pubDate' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wcf.acp.feedpage.pubDate{/lang}{if $sortField == 'sourceName'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
						
					{if $additionalColumns|isset}{@$additionalColumns}{/if}
				</tr>
			</thead>
			<tbody>
			{foreach from=$feedpageFeeds item=feed}
				<tr class="{cycle values="container-1,container-2"}">
					<td class="columnIcon">
						{if $this->user->getPermission('admin.content.feedpage.feedpageedit')}
							{if !$feed.disabled}
								<a href="index.php?action=FeedPageDisable&amp;feedID={@$feed.feedID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/enabledS.png" alt="" title="{lang}wcf.acp.feedpage.disable{/lang}" /></a>
							{else}
								<a href="index.php?action=FeedPageEnable&amp;feedID={@$feed.feedID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/disabledS.png" alt="" title="{lang}wcf.acp.feedpage.enable{/lang}" /></a>
							{/if}
							
							<a href="index.php?form=FeedPageEdit&amp;feedID={@$feed.feedID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/editS.png" alt="" title="{lang}wcf.acp.feedpage.edit{/lang}" /></a>
						{else}
							{if !$feed.disabled}
								<img src="{@RELATIVE_WCF_DIR}icon/enabledDisabledS.png" alt="" title="{lang}wcf.acp.feedpage.disable{/lang}" />
							{else}
								<img src="{@RELATIVE_WCF_DIR}icon/disabledDisabledS.png" alt="" title="{lang}wcf.acp.feedpage.enable{/lang}" />
							{/if}
							
							<img src="{@RELATIVE_WCF_DIR}icon/editDisabledS.png" alt="" title="{lang}wcf.acp.feedpage.edit{/lang}" />
						{/if}
						{if $this->user->getPermission('admin.content.feedpage.feedpagedelete')}
							<a onclick="return confirm('{lang}wcf.acp.feedpage.delete.sure{/lang}')" href="index.php?action=FeedPageDelete&amp;feedID={@$feed.feedID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/deleteS.png" alt="" title="{lang}wcf.acp.feedpage.delete{/lang}" /></a>
						{else}
							<img src="{@RELATIVE_WCF_DIR}icon/deleteDisabledS.png" alt="" title="{lang}wcf.acp.feedpage.delete{/lang}" />
						{/if}
						
						{if $feed.additionalButtons|isset}{@$feed.additionalButtons}{/if}
					</td>
					<td class="columnfeedID columnID">{@$feed.feedID}</td>
					<td class="columnfeedtitle columnText">
						{if $this->user->getPermission('admin.content.feedpage.feedpageedit')}
							<a href="index.php?form=FeedPageEdit&amp;feedID={@$feed.feedID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{$feed.title}</a>
						{else}
							{$feed.title}
						{/if}
					</td>
					<td class="columnfeedauthor columnText">{@$feed.author}</td>
					<td class="columnfeedpubDate columnText">{@$feed.pubDate|time}</td>
					
					{if $feed.additionalColumns|isset}{@$feed.additionalColumns}{/if}
				</tr>
			{/foreach}
			</tbody>
		</table>
	</div>

	<div class="contentFooter">
		{@$pagesLinks}
		
	{if $this->user->getPermission('admin.content.feedpage.feedpageadd')}
		<div class="largeButtons">
			<ul><li><a href="index.php?form=FeedPageAdd&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/feedpageAddM.png" alt="" title="{lang}wcf.acp.menu.link.content.feedpage.add{/lang}" /> <span>{lang}wcf.acp.menu.link.content.feedpage.add{/lang}</span></a></li></ul>
		</div>
	{/if}
	</div>
{/if}
{if 'FEEDPAGE_BRANDINGFREE'|defined == false}
	<div> 
		<div>
			<div style="text-align: center;">{lang}wcf.global.page.feedpage.copyright{/lang}</div>
		</div>
	</div>
{/if}

{include file='footer'}
<?xml version="1.0" encoding="{@CHARSET}"?>
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>{lang}wcf.feedpage.title{/lang}</title>
	<id>{@PAGE_URL}</id>
	<updated>{@'c'|gmdate:TIME_NOW}</updated>
	<link href="{@PAGE_URL}" />
	<generator url="http://community4wcf.de/">FeedPage Plugin by Community4WCF</generator>
	<subtitle>{lang}wcf.feedpage.description{/lang}</subtitle>
	
	{foreach from=$feedpageFeeds item=$feed}
		<entry>
			<title>{$feed.title}</title>
			<id>{if !FEEDPAGE_STANDARDLINK_ENABLE}{$feed.link}{else}{FEEDPAGE_STANDARDLINK}{/if}</id>
			<updated>{@'c'|gmdate:$feed.pubDate}</updated>
			<author>
				<name>{$feed.author}</name>
			</author>
			<content type="html"><![CDATA[{@$feed.description}]]></content>
			<link href="{$feed.link}" />
		</entry>
	{/foreach}
</feed>
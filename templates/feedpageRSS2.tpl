<?xml version="1.0" encoding="{@CHARSET}"?>
<rss version="2.0">
	<channel>
		<title>{lang}wcf.feedpage.title{/lang}</title>
		<link>{@PAGE_URL}</link>
		<description>{lang}wcf.feedpage.description{/lang}</description>
		<copyright>{lang}{PAGE_TITLE}{/lang}</copyright>
		<pubDate>{@'r'|gmdate:TIME_NOW}</pubDate>
		<lastBuildDate>{@'r'|gmdate:TIME_NOW}</lastBuildDate>
		<generator>FeedPage Plugin by Community4WCF</generator>
		<ttl>60</ttl>

		{if FEEDPAGE_IMAGE}<image>
			<url>{FEEDPAGE_IMAGE_URL}</url>
			<title>{lang}{PAGE_TITLE}{/lang}</title>
			<link>{@PAGE_URL}</link>
			<description></description>
		</image>{/if}

		{foreach from=$feedpageFeeds item=$feed}
				<item>
				<title>{$feed.title}</title>
				<author>{$feed.author}</author>
				<link>{if !FEEDPAGE_STANDARDLINK_ENABLE}{$feed.link}{else}{FEEDPAGE_STANDARDLINK}{/if}</link>
				<guid>{if !FEEDPAGE_STANDARDLINK_ENABLE}{$feed.link}{else}{FEEDPAGE_STANDARDLINK}{/if}</guid>
				<pubDate>{@'r'|gmdate:$feed.pubDate}</pubDate>
				<description><![CDATA[{@$feed.description}]]></description>
			</item>
	{/foreach}</channel>            
</rss>
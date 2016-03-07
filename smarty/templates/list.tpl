{* Article List Page *}
<div>
	{if is_null($query)}
		<h2>記事一覧</h2>
	{else}
		<h2>「{$query|escape:"html"}」での検索結果</h2>
	{/if}
	
	{foreach from=$articles item=article}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><a href="./show.php?a_id={$article['a_id']}">{$article['title']|escape:"html"}</a></h3>
		</div>
		<div class="panel-body">
			<div class="col-lg-8">
				<p>投稿者: {$article['name']|escape:"html"}</p>
				<p>国: {$article['country']|escape:"html"}</p>
				<p>大学: {$article['university']|escape:"html"}</p>
				<div>
					{$article['article']|escape:"html"}
				</div>
			</div>
			<div class="col-lg-4">
				{if !is_null($article['picture'])}
				<div>
					<img style="max-width: 200px; height: auto;" src="./picture.php?a_id={$article['a_id']}">
				</div>
				{/if}
			</div>	
		</div>
	</div>
	{foreachelse}
	<div>
		検索結果が見つかりませんでした。
	</div>
	{/foreach}

	{if count($articles)>0}
	<nav>
		<ul class="pager">
			<li class="previous {if $page==1}disabled{/if}">
				<a {if $page!=1}href="./list.php?page={$page-1}{if !is_null($query)}&query={$query}{/if}"{/if}>
					<span aria-hidden="true">&larr;</span>
					前へ
				</a>
			</li>
			<li class="next {if $page==$max_page}disabled{/if}">
				<a {if $page!=$max_page}href="./list.php?page={$page+1}{if !is_null($query)}&query={$query}{/if}"{/if}>
					次へ
					<span aria-hidden="true">&rarr;</span>
				</a>
			</li>
		</ul>
	</nav>
	{/if}

	<form action="./list.php" method="get" class="well">
		<h3>記事を探す</h3>
		<div class="input-group">
			<input type="text" name="query" class="form-control" placeholder="キーワード" {if !is_null($query)}value="{$query}"{/if}>
			<span class="input-group-btn">
				<button type="submit" class="btn btn-default" type="button">検索</button>
			</span>
		</div>
	</form>
	
</div>
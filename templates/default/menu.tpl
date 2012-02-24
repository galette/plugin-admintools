{if $login->isSuperAdmin()}
		<h1 class="nojs">{_T string="Admin Tools"}</h1>
		<ul>
			<li><a href="{$galette_base_path}{$galette_galette_admin_tools_path}admintools.php" title="{_T string="Various administrative tools"}">{_T string="Admin tools"}</a></li>
		</ul>
{/if}

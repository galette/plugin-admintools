    <section>
        <form action="" method="post">
            <fieldset>
                <legend class="ui-state-active ui-corner-top">{_T string="Content tools"}</legend>
                <div class="warningbox">
                    <p>{_T string="Make sure you've done a backup of the database before using any of the following tools!"}</p>
                </div>
                <article>
                    <p class="center">
                        <input name="inittexts" type="submit" value="{_T string="Reinitialize emails contents"}"/>
                        <input name="initfields" type="submit" value="{_T string="Reinitialize fields configuration"}"/>
                        <input name="initpdfmodels" type="submit" value="{_T string="Reinitialize PDF models"}"/>
                    </p>
                </article>
                <article>
                    <p class="center">
                        <input name="emptylogins" type="submit" value="{_T string="Generate values for empty logins and passwords"}"/>
                    </p>
                </article>
                <article>
                    <p class="center">
                        <input name="checkmodules" type="submit" value="{_T string="Check PHP modules"}"/>
                    </p>
                </article>
            </fieldset>
        </form>
    </section>
{if isset($modules_res)}
    <section id="modules" title="{_T string="Modules report"}">
        {$modules_res}
    </section>
    <script type="text/javascript">
        $(function(){
            $('#modules').dialog({
                modal: true,
                hide: 'fold',
                width: '40%'
            });
        });
    </script>
{/if}

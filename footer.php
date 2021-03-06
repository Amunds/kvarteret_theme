<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */
?>
		</div><!-- #main -->

		<div id="footer" role="contentinfo" class="cf">
			<div id="footer_content" class="cf">
				<div class="opening_hours_container cf">
					<span class="opening_title">
						Grøndahl Flygel- og pianolager (pub 1. etg)
					</span>
					<span class="opening_hours">
						Man 17:00-01:00<br />
						Tirs-ons 20:00-01:00<br />
						Tors-lør 19:00-03:30<br />
						Søn åpent ved arrangement
					</span>
				</div>
				<div class="opening_hours_container cf">
					<span class="opening_title">
						Stjernesalen (kafè 2. etg)
					</span>
					<span class="opening_hours">
						Man-ons 11:30-23:00<br />
						Tors 11:30-01:00<br />
						Fre 11:30-03:30<br />
						Lør 14:00-03:30
					</span>
				</div>
				<div class="opening_hours_container cf">
					<span class="opening_title">
						Matservering Stjernesalen
					</span>
					<span class="opening_hours">
						Man-fre: Lunch 11:30-15:00, middag 15:00-21:00<br />
						Lør: Brunch 14:00-17:00
					</span>
				</div>
				<br style="clear:both;display:block;height:0;" />
			</div>
		</div>
		
		<div id="sub_footer">
			Siden er utviklet av Webgruppen ved Det Akademiske Kvarters. For tekniske spørsmål kontakt <a href="mailto:webgruppen@kvarteret.no">webgruppen@kvarteret.no</a>. Det Akademiske Kvarter ble åpnet av Kronprins Haakon i 1995 og er studentenes kulturhus i Bergen. Huset er drevet på dugnad av og for studenter men er åpent for alle. En rekke organisasjoner låner lokaler og teknisk utstyr på Kvarteret gratis til sine arrangementer. Kvarteret har årlig over 1000 arrangementer, og omsetning på rundt 13 millioner. Med opptil 250 000 besøkende hvert år er det et yrende liv nesten hele døgnet.
		</div>
		
		<?php
			wp_footer();
		?>
	</body>
	
</html>

function spalanie()
    			{
    				var p = document.getElementById( "p" ).value;
    				var d = document.getElementById( "d" ).value;
    				var out = document.getElementById( "w" );

    				if( isNaN( p ) || isNaN( d ) )
    					out.innerHTML = "Dystans i ilosć paliwa muszą być liczbami!";
    				else
    					{
    						if( d != 0 )
    							{
    								var wynik = ( Math.abs( p ) * 100 ) / Math.abs( d );
    								out.innerHTML = " " + wynik.toFixed( 2 ) + " l/100km";
    							}
    						else
    							out.innerHTML = "Dystans nie może być zerowy!";
    			}
    		}

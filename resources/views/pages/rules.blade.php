<!doctype html>

	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<title>Laravel</title>

			<!-- Fonts -->
			<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

			<!-- Styles -->
			<link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

			<!-- Bulma Version 0.7.2-->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" />
			<link rel="stylesheet" href="https://unpkg.com/bulma-modal-fx/dist/css/modal-fx.min.css" />
			<style>
				.columns:nth-child(2)
				{margin-top: -10rem;}
				#con {
                    padding-top: 20px;
                }
                .card-content{
                    transition: box-shadow .3s;
                }
                .card-content:hover{
                    box-shadow: 0 0 31px rgba(0,0,0,.4);
                    cursor: pointer;
                }
                .card-image{
                    cursor: pointer;
                }
			</style>

		</head>
	<body>
		<?php
				$number_col = 3;
		config(['global.pagename' => 'rules']);
		?>
		@include('included.nav')
		<?php
			$rule = DB::table('rules')->get();
			foreach ($rule as $r){
			    if($number_col%3==0)
			        {   echo '<section class="container" id = "con">';
			            echo '<div class="columns features">';
					}
		?>
				<div class="column is-4 modal-button" data-target="modal-card<?php echo $r->id; ?>">
					<div class="card is-shady">
						<div class="card-image">
							<figure class="image is-4by3">
								<?php echo '<img src = "'.url()->current().$r->image.'" alt="Placeholder image">';?>
							</figure>
						</div>
						<div class="card-content">
							<div class="content">
								<h4><?php echo $r->title; ?></h4>
								<p><?php $pos=strpos($r->description, ' ', 120);
                                    echo substr($r->description,0,$pos );?> . . .
								</p>
								<span class="button is-link modal-button" style="background-color: gray">More info</span>
							</div>
						</div>
					</div>
				</div>
		<?php
        if(($number_col + 1)%3==0)
        {
            echo '</div>';
            echo '</section>';
        }
        $number_col++;
        }
		?>
		<!--  ===============
        HERE BE MODALS
        ===============  -->
		<!-- 3dFlipVertical card tiny -->
        <?php
        $rule = DB::table('rules')->get();
        foreach ($rule as $r){
        ?>
        <div id="modal-card<?php echo $r->id; ?>" class="modal modal-fx-3dSlit">
            <div class="modal-background"></div>
            <div class="modal-content is-tiny">
                <!-- content -->
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <?php echo '<img src = "'.url()->current().$r->image.'" alt="Placeholder image">';?>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <?php echo '<img src = "'.url()->current().'/../img/we.jpg"  alt="linda barret avatar">';?>
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4"><?php echo $r->title; ?></p>
                            </div>
                        </div>
                        <div class="content">
                            <p><?php echo $r->description;?></p>
                        </div>
                    </div>
                </div>
                <!-- end content -->
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>
        <!-- end tiny modal card -->
        <?php
        }
        ?>


		<script src="https://unpkg.com/bulma-modal-fx/dist/js/modal-fx.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	</body>

</html>

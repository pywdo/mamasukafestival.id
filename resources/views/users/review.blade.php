@extends('layouts.app')
@section('content')
<div class="container mt-5">
<div id="review_form_wrapper">
	
							
										
											

											<div id="review_form">
                                            @if(Session::has('message'))
                                            <p class="alert alert-success" role="alert">{{ Sssion::get('message') }}</p>
                                            @endif
												<div id="respond" class="comment-respond"> 
													{{-- <form wire:submit.prevent="addReview" id="commentform" class="comment-form"> --}}
													 <form method="POST" action="{{ route('users.review.store') }}" enctype="multipart/form-data" id="commentform" class="comment-form" novalidate>
            										 @csrf
													<?php if(isset($_GET['courses_id'])): ?>
													
															<input type="hidden" name="courses_id"  value="{!! $_GET['courses_id'] !!}">
													
															
													<?php endif; ?>

													<input type="text" class="form-control col-4" name="username"  value="{{ auth()->user()->name }}" readonly>
													@error('username') <span class="text-danger">{{ $message }}</span>@enderror
													 	<p class="comment-notes">
															<span id="email-notes"><h3>Beri Ulasan Kursus</h3><span class="required"></span>
														</p>
														<div class="comment-form-rating">
															<span>Your rating</span>
															<p class="stars">
																<label for="rated-1"></label>
																<input type="radio" id="rated-1" name="rating" value="1" >
																<label for="rated-2"></label>
																<input type="radio" id="rated-2" name="rating" value="2" >
																<label for="rated-3"></label>
																<input type="radio" id="rated-3" name="rating" value="3" >
																<label for="rated-4"></label>
																<input type="radio" id="rated-4" name="rating" value="4" >
																<label for="rated-5"></label>
																<input type="radio" id="rated-5" name="rating" value="5" checked="checked">
															@error('rating') <span class="text-danger">{{ $message }}</span>@enderror
                                                            </p>
														</div><br>
														<p class="comment-form-comment">
															<label for="comment">Your review <span class="required">*</span>
															</label>
															<textarea id="comment" name="comment" cols="45" rows="8" wire:model="comment"></textarea>
														@error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                                                        </p>
														<p class="form-submit">
														
															<input name="submit" type="submit" id="submit" class="submit" value="Submit">
														</p>
													</form>

												</div><!-- .comment-respond-->
											</div><!-- #review_form -->
										</div><!-- #review_form_wrapper -->
</div>
</div>
@endsection

<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<h2><?=$title?></h2>
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1><?=!empty($type) ? $type : ''?></h1></div>
	</div>
</div>
<div class="cluster">
	<div class="container resources-choose">
		<form action="" method="get" accept-charset="utf-8">
		<div class="row">
			<div class="col-md-2">
				<div class="filter-by">
					Filter by
				</div>
			</div>
			
			<div class="col-md-3" style="padding-right: 0;">
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="search" placeholder="Search <?=!empty($type) ? $type : ''?>" value="<?=$search_text?>" aria-label="Search News" aria-describedby="button-addon2">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="filter-or">
					Or
				</div>
			</div>
			<div class="col-md-3" style="padding-left: 0;">
				<div class="input-group mb-3">
					<select class="custom-select">
						<option selected>Search News by Jurisdiction</option>
						<option value="1">One</option>
						<option value="2">Two</option>
						<option value="3">Three</option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="filter-clear">
					Clear
				</div>
			</div>
		</div>
		</form>
		<div class="row">
			<? if (!empty($items[0])) { $nation_alias = $this->m_nation->load($items[0]->nation_id)->alias; ?>
			<div class="col-md-4">
				<div class="mer-item border-red">
					<a href="<?=site_url("blogs/{$nation_alias}/{$items[0]->alias}")?>">
						<div class="bg-item" style="background-image: url(<?=BASE_URL.$items[0]->thumbnail?>);">
							<div class="info">
								<h5 class="title-item"><?=$items[0]->title?></h5>
								<p>
									<?=word_limiter(strip_tags($items[0]->summary),20)?>
								</p>
								<a href="<?=site_url("blogs/{$nation_alias}/{$items[0]->alias}")?>" class="btn-viewmore">View more</a>
								<div class="date">
									<label><?=date('d',strtotime($items[0]->created_date))?></label><br>
									<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[0]->created_date))?></label>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<? } ?>
			<div class="col-md-8">
				<div class="row">
					<? if (!empty($items[1])) { $nation_alias = $this->m_nation->load($items[1]->nation_id)->alias;?>
					<div class="col-md-4">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[1]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[1]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[1]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[1]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[1]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[1]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
					<? if (!empty($items[2])) { $nation_alias = $this->m_nation->load($items[2]->nation_id)->alias;?>
					<div class="col-md-4">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[2]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[2]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[2]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[2]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[2]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[2]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
					<? if (!empty($items[3])) { $nation_alias = $this->m_nation->load($items[3]->nation_id)->alias;?>
					<div class="col-md-4">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[3]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[3]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[3]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[3]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[3]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[3]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
				<div class="row">
					<? if (!empty($items[4])) { $nation_alias = $this->m_nation->load($items[4]->nation_id)->alias;?>
					<div class="col-md-5">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[4]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[4]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[4]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[4]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[4]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[4]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
					<? if (!empty($items[5])) { $nation_alias = $this->m_nation->load($items[5]->nation_id)->alias;?>
					<div class="col-md-7">
						<div class="mer-item border-red">
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[5]->alias}")?>">
								<div class="bg-item" style="background-image: url(<?=BASE_URL.$items[5]->thumbnail?>);">
									<div class="info">
										<h5 class="title-item"><?=$items[5]->title?></h5>
										<p>
											<?=word_limiter(strip_tags($items[5]->summary),20)?>
										</p>
										<a href="<?=site_url("blogs/{$nation_alias}/{$items[5]->alias}")?>" class="btn-viewmore">View more</a>
										<div class="date">
											<label><?=date('d',strtotime($items[5]->created_date))?></label><br>
											<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[5]->created_date))?></label>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<? } ?>
				</div>
			</div>
			<div class="col-md-5">
				<div class="row">
					<? if (!empty($items[6])) { $nation_alias = $this->m_nation->load($items[6]->nation_id)->alias;?>
					<div class="col-md-6">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[6]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[6]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[6]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[6]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[6]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[6]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
					<? if (!empty($items[7])) { $nation_alias = $this->m_nation->load($items[7]->nation_id)->alias;?>
					<div class="col-md-6">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[7]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[7]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[7]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[7]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[7]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[7]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<? if (!empty($items[8])) { $nation_alias = $this->m_nation->load($items[8]->nation_id)->alias;?>
					<div class="col-md-4">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[8]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[8]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[8]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[8]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[8]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[8]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
					<? if (!empty($items[9])) { $nation_alias = $this->m_nation->load($items[9]->nation_id)->alias;?>
					<div class="col-md-4">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[9]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[9]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[9]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[9]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[9]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[9]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
					<? if (!empty($items[10])) { $nation_alias = $this->m_nation->load($items[10]->nation_id)->alias;?>
					<div class="col-md-4">
						<a href="<?=site_url("blogs/{$nation_alias}/{$items[10]->alias}")?>">
							<div class="re-item border-red">
								<div class="bg-re-item" style="background-image: url(<?=BASE_URL.$items[10]->thumbnail?>);">
									<div class="date">
										<label><?=date('d',strtotime($items[10]->created_date))?></label><br>
										<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[10]->created_date))?></label>
									</div>
								</div>
							</div>
							<h5 class="title-re-item"><?=$items[10]->title?></h5>
							<a href="<?=site_url("blogs/{$nation_alias}/{$items[10]->alias}")?>" class="btn btn-viewmore">view more</a>
						</a>
					</div>
					<? } ?>
				</div>
			</div>
			<? if (!empty($items[11])) { $nation_alias = $this->m_nation->load($items[11]->nation_id)->alias;?>
			<div class="col-md-4">
				<div class="mer-item border-red">
					<a href="<?=site_url("blogs/{$nation_alias}/{$items[11]->alias}")?>">
						<div class="bg-item" style="background-image: url(<?=BASE_URL.$items[11]->thumbnail?>);">
							<div class="info">
								<h5 class="title-item"><?=$items[11]->title?></h5>
								<p>
									<?=word_limiter(strip_tags($items[11]->summary),20)?>
								</p>
								<a href="<?=site_url("blogs/{$nation_alias}/{$items[11]->alias}")?>" class="btn-viewmore">View more</a>
								<div class="date">
									<label><?=date('d',strtotime($items[11]->created_date))?></label><br>
									<label style="border-top: 1px solid #e6e6e6; font-size: 13px;"><?=date('M',strtotime($items[11]->created_date))?></label>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<? } ?>
		</div>
		<div class="text-center"><?=$pagination?></div>
	</div>
</div>
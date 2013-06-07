<div class="container main">
	<div class="row">
		<div class="span8">
			<form class="form-horizontal" action="/settings" method="POST" id="settingsForm">
				<div class="control-group">
					<label class="control-label" for="repo">Git repo:</label>
					<div class="controls">
						<input class="input-xxlarge" type="text" name="repo"
							placeholder="Enter the path to your git repository"
							value="<?= $settings['repoPath'] ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="path">Clone path:</label>
					<div class="controls">
						<input class="input-xxlarge" type="text" name="path"
							placeholder="Enter the path to your repo copy"
							value="<?= $settings['clonePath'] ?>">
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button class="btn btn-inverse" type="submit">Save settings</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="/js/settings.js"></script>
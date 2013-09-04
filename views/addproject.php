<div class="container main">
	<div class="row-fluid">
		<div class="span9">
			<form class="form-horizontal" action="/new" method="POST" id="addProjectForm">
				<div class="control-group">
					<label class="control-label" for="repo">Project name:</label>
					<div class="controls">
						<input class="input-xxlarge" type="text" name="name"
						       placeholder="Enter the project name"
						       value="">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="repo">Teammates:</label>
					<div class="controls">
						<textarea name="teammates" class="stream" rows="8" placeholder="Add E-mail addresses here"></textarea>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button class="btn btn-inverse" type="submit">Create project</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="/js/project.js"></script>
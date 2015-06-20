var FileUploadApp = React.createClass({

	getInitialState: function() {
		return {
			files: []
		};
	},

	componentDidMount: function() {
		var uri = 'files';

		$.ajax({
			url: uri,
			context: this,
			headers: {
				'X-CSRF-Token': $('meta[name="csrf_token"]').attr('value')
			},
			statusCode: {
				404: () => {
					// username in URI not valid
					if (this.isMounted()) {
						var message = 'Whoops! We ran into a problem. Try refreshing the page.';
						this.displayError(message);
					}
				},
				500: () => {
					// server error
					if (this.isMounted()) {
						var message = 'Whoops! We ran into a problem. Try refreshing the page.';
						this.displayError(message);
					}
				}
			},
			success: (response) => {
				response.payload.map( (file) => {
					this.setState({ files: this.state.files.concat({ filename: file.filename, type: file.type, size: file.size }) });
				});
			}
		});
	},

	displayError: function(message) {
		alert(message);
	},

	render: function() {
		return (
			<div>
				<h3>Your Uploaded Files:</h3>

				<FileList files={ this.state.files } />
			</div>
		);
	}

});

React.render(<FileUploadApp />, document.getElementById('app'));
var FileList = React.createClass({

	render: function() {
		// set up some indication to user that no files have been uploaded so far
		var none = '';
		if (this.props.files.length < 1)
		{
			none = 'No files yet!';
		}

		// go through each file and see if it matches the filter text
		var rows = [];
		this.props.files.forEach( (file) => {
			var path = '/users/' + window.config.username + '/files/' + file.filename;

			if (file.filename.indexOf(this.props.filterText) !== -1)
			{
				rows.push(<li>{file.filename} ({file.size / 1000}KB) <a href={ path } target="_blank">Download</a></li>)
			}
		});

		return (
			<ul>
				{ rows }
				{ none }
			</ul>
		);
	}

});
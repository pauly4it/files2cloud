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
			if (file.filename.indexOf(this.props.filterText) !== -1)
			{
				rows.push(<li>{file.filename} / Type: {file.type} / ({file.size / 1000}KB)</li>)
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
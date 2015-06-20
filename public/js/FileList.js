var FileList = React.createClass({

	displayFile: function(file) {
		// convert to Kb
		var size = file.size / 1000;

		return <li>
					{file.filename} / Type: {file.type} / ({size}KB)
				</li>;
	},

	displayNoFiles: function() {
		return <li> No files yet! </li>
	},

	render: function() {
		var none = '';
		if (this.props.files.length < 1)
		{
			none = 'No files yet!';
		}

		return (
			<ul>
				{ this.props.files.map(this.displayFile) }
				{ none }
			</ul>
		);
	}

});
var FileSearchBar = React.createClass({

	onChange: function() {
		// trigger the onType function when the filter text changes
		this.props.onType(this.refs.filter.getDOMNode().value);
	},

	render: function() {
		return (
			<form>
				<input className="filter-box" ref="filter" value={this.props.filterText} type="text" placeholder="Filter by filename..." onChange={this.onChange} />
			</form>
		);
	}

});
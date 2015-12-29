define(function (require) {

	var elgg = require('elgg');
	var $ = require('jquery');

	var Progress = function (time) {
		this.time = time;
		this.lastLine = '';
		this.timeout = false;
	};

	Progress.prototype = {
		addLine: function (line) {
			if (line !== this.lastLine) {
				var $line = $('<div />').html(line);
				$('#csv-process-results').append($line);
				this.lastLine = line;
			}
		},
		getLine: function () {
			var self = this;
			elgg.get('ajax/view/csv_process/ajax/progress', {
				data: {
					time: self.time
				},
				success: function (line) {
					self.addLine(line);
					self.init();
				}
			});
		},
		init: function () {
			if (this.timeout) {
				window.clearTimeout(this.timeout);
			}
			this.timeout = window.setTimeout(this.getLine.bind(this), 2000);
		}
	};

	return Progress;
});
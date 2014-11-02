module.exports = (grunt) ->
	grunt.initConfig

		options:
			app: 'public/assets'
			dist: 'public/assets-dist'
			layouts: 'app/views'
			layoutsDist: 'app/views-dist'

		bowercopy:
			bootstrap:
				src: 'bootstrap/dist/*'
				dest: '<%= options.app %>/library/bootstrap'
			js:
				options:
					destPrefix: '<%= options.app %>/library/js'
				files:
					'jquery.min.js': 'jquery/dist/jquery.min.js'
					'require.js' : 'requirejs/require.js'
			ng:
				options:
					destPrefix: '<%= options.app %>/library/ng'
				files:
					'angular.min.js': 'angular/angular.min.js'
					'angular-resource.min.js': 'angular-resource/angular-resource.min.js'
					'angular-route.min.js': 'angular-route/angular-route.min.js'
					'angular-ui-router.min.js': 'angular-ui-router/release/angular-ui-router.min.js'
					'angular-animate.min.js': 'angular-animate/angular-animate.min.js'

		smart_assets:
			compile:
				options:
					files:
						cwd: '<%=options.app%>'
						dest: '<%=options.dist%>'
						cleanDist: true

					html:
						cwd: '<%=options.layouts%>'
						dest: '<%=options.layoutsDist%>'
						src: '**/*.php'
						assetDir: 'public'

		watch:
			all:
				files: [
					'<%=options.app%>/**/*'
					'<%=options.layouts%>/**/*'
				]
				tasks: ['smart_assets']

	grunt.loadNpmTasks('grunt-contrib-coffee');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-smart-assets');
	grunt.loadNpmTasks('grunt-bowercopy')
	grunt.registerTask('default', ['bowercopy'])


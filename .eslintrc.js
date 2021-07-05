module.exports = {
	root: true,
	env: {
		browser: true,
		commonjs: true,
		es6: true,
		node: true,
	},
	extends: ['plugin:@wordpress/eslint-plugin/recommended-with-formatting'],
	rules: {
		'array-bracket-spacing': ['error', 'never'],
		'space-in-parens': ['error', 'never'],
	},
};

const path = require('path');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const TerserPlugin = require("terser-webpack-plugin");

// PrestShop folders, we should use process.env.PWD instead of __dirname in case the module is symlinked
const psRootDir = path.resolve(__dirname, '../../../../../');
const psJsDir = path.resolve(psRootDir, 'admin-dev/themes/new-theme/js');
const psComponentsDir = path.resolve(psJsDir, 'components');

const commonConfig = {
  externals: {
    jquery: 'jQuery',
  },
  entry: {
    admin: ['./admin/grid', './admin/retailer-form'],
    common: './common/index',
  },
  output: {
    path: path.resolve(__dirname, './../dist'),
    filename: '[name].bundle.js',
    libraryTarget: 'window',
    library: '[name]',
  },
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@components': psComponentsDir,
    },
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        include: path.resolve(__dirname, './admin'),
        use: [{
          loader: 'babel-loader',
          options: {
            presets: [
              '@babel/preset-env'
            ],
          },
        }],
      },
      {
        test: /\.js$/,
        include: path.resolve(__dirname, './common'),
        use: [{
          loader: 'babel-loader',
          options: {
            presets: [
              '@babel/preset-env',
              {
                'plugins': [
                  '@babel/plugin-proposal-private-methods',
                  '@babel/plugin-proposal-class-properties'
                ]
              }
            ],
          },
        }],
      },
      {
        test: /\.js$/,
        include: psJsDir,
        use: [{
          loader: 'babel-loader',
          options: {
            presets: [
              '@babel/preset-env'
            ],
          },
        }],
      },
      {
        test: /jquery-ui\.js/,
        use: 'imports-loader?define=>false&this=>window',
      },
      {
        test: /jquery\.magnific-popup\.js/,
        use: 'imports-loader?define=>false&exports=>false&this=>window',
      },
      // FILES
      {
        test: /.(jpg|png|woff2?|eot|otf|ttf|svg|gif)$/,
        loader: 'file-loader?name=[hash].[ext]',
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin(['js'], {
      root: path.resolve(__dirname, '../../views')
    }),
    new webpack.ProvidePlugin({
      $: 'jquery', // needed for jquery-ui
      jQuery: 'jquery',
    }),
  ],
};

/**
 * Returns the development webpack config,
 * by merging development specific configuration with the common one.
 */
function devConfig() {
  let dev = Object.assign(
    commonConfig,
    {
      devtool: 'inline-source-map',
      mode: 'development',
      devServer: {
        hot: true,
        contentBase: path.resolve(__dirname, '/public'),
        publicPath: '/',
      },
    }
  );

  return dev;
}

/**
 * Returns the production webpack config,
 * by merging production specific configuration with the common one.
 *
 * @param {Boolean} analyze If true, bundle analyze plugin will launch
 */
function prodConfig(analyze) {
  let prod = Object.assign(
    commonConfig,
    {
      stats: 'minimal',
      mode: 'production',
      optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()],
      },
    }
  );

  return prod;
}

/**
 * Three mode available:
 *  build = production mode
 *  build:analyze = production mode with bundler analyzer
 *  dev = development mode
 */
module.exports = () => (
  process.env.NODE_ENV === 'production' ?
    prodConfig() :
    devConfig()
);

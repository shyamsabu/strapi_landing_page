'use strict';

/**
 * automated-sec service
 */

const { createCoreService } = require('@strapi/strapi').factories;

module.exports = createCoreService('api::automated-sec.automated-sec');

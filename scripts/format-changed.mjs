#!/usr/bin/env node
/* eslint-env node */
/**
 * Format only modified or added files with Prettier.
 *
 * - Considers files changed compared to HEAD (modified, added, renamed, etc.).
 * - Includes untracked (new) files that are not ignored by .gitignore.
 * - Filters to Prettier-supported extensions we use in this repo.
 * - If no files match, exits successfully with a message.
 */

import { execSync, spawnSync } from 'node:child_process';
import { existsSync } from 'node:fs';

function run(cmd) {
    try {
        return execSync(cmd, { encoding: 'utf8', stdio: ['ignore', 'pipe', 'ignore'] }).trim();
    } catch {
        return '';
    }
}

function unique(arr) {
    return Array.from(new Set(arr.filter(Boolean)));
}

// Extensions Prettier should handle in this project
const EXT_REGEX = /\.(?:js|jsx|mjs|cjs|ts|tsx|json|css|scss|md|yml|yaml|html|vue|svelte|blade\.php)$/i;

// Gather changed files vs HEAD (added, copied, modified, renamed, etc.)
const changedVsHead = run('git diff --name-only --diff-filter=ACMRTUXB HEAD');
// Also include currently modified tracked files (not yet staged) as a fallback
const modifiedTracked = run('git ls-files -m');
// Include untracked (new) files that are not ignored
const untracked = run('git ls-files --others --exclude-standard');

const files = unique([...changedVsHead.split('\n'), ...modifiedTracked.split('\n'), ...untracked.split('\n')]).filter(
    f => EXT_REGEX.test(f) && existsSync(f)
);

if (files.length === 0) {
    console.log('No modified or added files to format.');
    process.exit(0);
}

// Prefer using the local Prettier binary
const prettierCmd = process.platform === 'win32' ? 'npx.cmd' : 'npx';

const result = spawnSync(prettierCmd, ['prettier', '--write', ...files], {
    stdio: 'inherit',
    env: process.env,
});

process.exit(result.status ?? 0);

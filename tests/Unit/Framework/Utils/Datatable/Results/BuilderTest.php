<?php
/*
 garlic-hub: Digital Signage Management Platform

 Copyright (C) 2025 Nikolaos Sagiadinos <garlic@saghiadinos.de>
 This file is part of the garlic-hub source code

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU Affero General Public License, version 3,
 as published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU Affero General Public License for more details.

 You should have received a copy of the GNU Affero General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
declare(strict_types=1);

namespace Tests\Unit\Framework\Utils\Datatable\Results;

use App\Framework\Utils\Datatable\Results\Builder;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
	private Builder $builder;

	protected function setUp(): void
	{
		parent::setUp();
		$this->builder = new Builder();
	}

	#[Group('units')]
	public function testGetHeaderFieldsInitiallyEmpty(): void
	{
		static::assertSame([], $this->builder->getHeaderFields());
	}

	#[Group('units')]
	public function testCreateFieldAddsHeaderField(): void
	{
		$this->builder->createField('test_field', true);

		$fields = $this->builder->getHeaderFields();
		static::assertCount(1, $fields);
		static::assertSame('test_field', $fields[0]->getName());
		static::assertTrue($fields[0]->isSortable());
	}

	#[Group('units')]
	public function testMultipleCreateFieldCalls(): void
	{
		$this->builder->createField('field1', false);
		$this->builder->createField('field2', true);

		$fields = $this->builder->getHeaderFields();
		static::assertCount(2, $fields);
		static::assertSame('field1', $fields[0]->getName());
		static::assertFalse($fields[0]->isSortable());
		static::assertSame('field2', $fields[1]->getName());
		static::assertTrue($fields[1]->isSortable());
	}
}
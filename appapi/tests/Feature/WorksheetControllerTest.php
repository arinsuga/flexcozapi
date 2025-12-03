<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Contracts\WorksheetRepositoryInterface;
use Mockery;

class WorksheetControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(WorksheetRepositoryInterface::class);
        $this->app->instance(WorksheetRepositoryInterface::class, $this->repository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_returns_list_of_all_worksheets()
    {
        $worksheets = [
            ['id' => 1, 'sheet_code' => 'WS001', 'sheet_type' => 0, 'project_id' => 1, 'sheetgroup_id' => 1],
            ['id' => 2, 'sheet_code' => 'WS002', 'sheet_type' => 1, 'project_id' => 1, 'sheetgroup_id' => 1],
        ];

        $this->repository
            ->shouldReceive('all')
            ->once()
            ->andReturn($worksheets);

        $response = $this->withoutMiddleware()
            ->getJson('/api/worksheets');

        $response->assertStatus(200)
            ->assertJson(['data' => $worksheets]);
    }

    /** @test */
    public function it_returns_a_single_worksheet()
    {
        $worksheet = ['id' => 1, 'sheet_code' => 'WS001', 'sheet_type' => 0, 'project_id' => 1, 'sheetgroup_id' => 1];

        $this->repository
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($worksheet);

        $response = $this->withoutMiddleware()
            ->getJson('/api/worksheets/1');

        $response->assertStatus(200)
            ->assertJson(['data' => $worksheet]);
    }

    /** @test */
    public function it_returns_404_when_worksheet_not_found()
    {
        $this->repository
            ->shouldReceive('find')
            ->with(999)
            ->once()
            ->andReturn(null);

        $response = $this->withoutMiddleware()
            ->getJson('/api/worksheets/999');

        $response->assertStatus(404)
            ->assertJson(['error' => 'Worksheet not found']);
    }

    /** @test */
    public function it_returns_worksheets_by_project()
    {
        $worksheets = [
            ['id' => 1, 'sheet_code' => 'WS001', 'sheet_type' => 0, 'project_id' => 1, 'sheetgroup_id' => 1],
            ['id' => 2, 'sheet_code' => 'WS002', 'sheet_type' => 1, 'project_id' => 1, 'sheetgroup_id' => 1],
        ];

        $this->repository
            ->shouldReceive('getWorksheetsByProject')
            ->with(1)
            ->once()
            ->andReturn($worksheets);

        $response = $this->withoutMiddleware()
            ->getJson('/api/projects/1/worksheets');

        $response->assertStatus(200)
            ->assertJson(['data' => $worksheets]);
    }

    /** @test */
    public function it_returns_worksheets_by_sheet_group()
    {
        $worksheets = [
            ['id' => 1, 'sheet_code' => 'WS001', 'sheet_type' => 0, 'project_id' => 1, 'sheetgroup_id' => 1],
            ['id' => 2, 'sheet_code' => 'WS002', 'sheet_type' => 1, 'project_id' => 1, 'sheetgroup_id' => 1],
        ];

        $this->repository
            ->shouldReceive('getWorksheetsBySheetGroup')
            ->with(1)
            ->once()
            ->andReturn($worksheets);

        $response = $this->withoutMiddleware()
            ->getJson('/api/sheetgroups/1/worksheets');

        $response->assertStatus(200)
            ->assertJson(['data' => $worksheets]);
    }

    /** @test */
    public function it_returns_worksheets_by_vendor()
    {
        $worksheets = [
            ['id' => 1, 'sheet_code' => 'WS001', 'sheet_type' => 0, 'project_id' => 1, 'sheetgroup_id' => 1],
            ['id' => 2, 'sheet_code' => 'WS002', 'sheet_type' => 1, 'project_id' => 1, 'sheetgroup_id' => 1],
        ];

        $this->repository
            ->shouldReceive('getWorksheetsByVendor')
            ->with(1)
            ->once()
            ->andReturn($worksheets);

        $response = $this->withoutMiddleware()
            ->getJson('/api/vendors/1/worksheets');

        $response->assertStatus(200)
            ->assertJson(['data' => $worksheets]);
    }

    /** @test */
    public function it_creates_a_new_worksheet()
    {
        $worksheetData = [
            'sheet_code' => 'WS003',
            'sheet_type' => 0,
            'project_id' => 1,
            'sheetgroup_id' => 1,
        ];

        $createdWorksheet = array_merge(['id' => 3], $worksheetData);

        $this->repository
            ->shouldReceive('create')
            ->with($worksheetData)
            ->once()
            ->andReturn($createdWorksheet);

        $response = $this->withoutMiddleware()
            ->postJson('/api/worksheets', $worksheetData);

        $response->assertStatus(201)
            ->assertJson(['data' => $createdWorksheet]);
    }

    /** @test */
    public function it_validates_required_fields_when_creating_worksheet()
    {
        $response = $this->withoutMiddleware()
            ->postJson('/api/worksheets', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sheet_code', 'project_id', 'sheetgroup_id']);
    }

    /** @test */
    public function it_validates_sheet_type_values()
    {
        $response = $this->withoutMiddleware()
            ->postJson('/api/worksheets', [
                'sheet_code' => 'WS003',
                'sheet_type' => 5, // Invalid value
                'project_id' => 1,
                'sheetgroup_id' => 1,
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sheet_type']);
    }

    /** @test */
    public function it_updates_an_existing_worksheet()
    {
        $updateData = [
            'sheet_code' => 'WS001-UPDATED',
            'sheet_type' => 1,
        ];

        $existingWorksheet = ['id' => 1, 'sheet_code' => 'WS001', 'sheet_type' => 0, 'project_id' => 1, 'sheetgroup_id' => 1];
        $updatedWorksheet = array_merge($existingWorksheet, $updateData);

        $this->repository
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($existingWorksheet);

        $this->repository
            ->shouldReceive('update')
            ->with(1, $updateData)
            ->once()
            ->andReturn($updatedWorksheet);

        $response = $this->withoutMiddleware()
            ->putJson('/api/worksheets/1', $updateData);

        $response->assertStatus(200)
            ->assertJson(['data' => $updatedWorksheet]);
    }

    /** @test */
    public function it_returns_404_when_updating_non_existent_worksheet()
    {
        $this->repository
            ->shouldReceive('find')
            ->with(999)
            ->once()
            ->andReturn(null);

        $response = $this->withoutMiddleware()
            ->putJson('/api/worksheets/999', ['sheet_code' => 'TEST']);

        $response->assertStatus(404)
            ->assertJson(['error' => 'Worksheet not found']);
    }

    /** @test */
    public function it_deletes_a_worksheet()
    {
        $worksheet = ['id' => 1, 'sheet_code' => 'WS001', 'sheet_type' => 0, 'project_id' => 1, 'sheetgroup_id' => 1];

        $this->repository
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($worksheet);

        $this->repository
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn(true);

        $response = $this->withoutMiddleware()
            ->deleteJson('/api/worksheets/1');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Worksheet deleted successfully']);
    }

    /** @test */
    public function it_returns_404_when_deleting_non_existent_worksheet()
    {
        $this->repository
            ->shouldReceive('find')
            ->with(999)
            ->once()
            ->andReturn(null);

        $response = $this->withoutMiddleware()
            ->deleteJson('/api/worksheets/999');

        $response->assertStatus(404)
            ->assertJson(['error' => 'Worksheet not found']);
    }
}
